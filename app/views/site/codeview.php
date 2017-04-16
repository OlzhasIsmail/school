<?php

use yii\helpers\Html;

$this->title = 'Codeview';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-about">

    <textarea id = "code">   
    </textarea>

<script type="text/javascript">
	var username = '<?= $username?>';
</script>

<script type='text/javascript' src='https://cdn.firebase.com/js/client/1.0.15/firebase.js'></script>
<script type="text/javascript" src="/js/app.js"></script>
