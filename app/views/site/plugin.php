<?php
?>

import sublime, sublime_plugin
from xml.etree import ElementTree as ET
import urllib.parse
import urllib.request
import json
import difflib
from difflib import *

class CodeBroadcast(sublime_plugin.EventListener):
    last_text = None
    FB_URL = "https://texttransfer-7c612.firebaseio.com/<?= $username ?>/codes/"
    key = None

    def send_to_fb(self, url, _json):
        if self.key:
            url = self.FB_URL + self.key + ".json"
        else:
            url = self.FB_URL + ".json"
        data = json.dumps(_json).encode('utf-8')
        headers = {'Content-Type': 'application/json'}
        req = urllib.request.Request(url, data, headers)
        if self.key:
            req.get_method = lambda: 'PATCH'
        res = urllib.request.urlopen(req).read().decode('utf-8')
        return json.loads(res)

    def on_modified_async(self, view):
        current_text = view.substr(sublime.Region(0, view.size()))
        d = difflib.Differ()
        if self.last_text is not None:
            diff = d.compare(self.last_text.splitlines(), current_text.splitlines())
            values = {
                "text": "\n".join(diff)
            }
            response = self.send_to_fb(self.FB_URL, values)
            self.send_to_fb(self.FB_URL, {"key": self.key})
            # self.key = response["name"]
        else:
            values = {"text": current_text}
            response = self.send_to_fb(self.FB_URL, values)
            self.key = response["name"]
            # self.send_to_fb(self.FB_URL, {"key": self.key})
        self.last_text = current_text
