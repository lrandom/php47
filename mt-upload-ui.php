<?php

if (isset($_FILES['img']) && count($_FILES['img']) > 0) {
    for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
        print_r($_FILES['img'][$i]);
        move_uploaded_file($_FILES['img']['tmp_name'][$i], 'uploads/' . $_FILES['img']['name'][$i]);
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <div class="input-file-field-wrapper">
        <input type="file" name="img[]" style="display: block;margin-bottom: 10px">
    </div>

    <div role="button" class="btn-add-input-field">
        <div>+</div>
    </div>


    <button>Submit</button>
</form>

<script>
    const btnAddInputFieldNode = document.querySelector('.btn-add-input-field');
    btnAddInputFieldNode.addEventListener('click', function () {
        const inputFileFieldWrapperNode = document.querySelector('.input-file-field-wrapper');
        const firstChildInputFieldNode = inputFileFieldWrapperNode.querySelector('input:first-child');
        const inputFiledCloneNode = firstChildInputFieldNode.cloneNode(true);
        inputFileFieldWrapperNode.appendChild(inputFiledCloneNode);

        /*   const inputFileFiledNodes = inputFileFieldWrapperNode.getElementsByTagName('input');
           for (let i = 0; i < inputFileFiledNodes.length; i++) {
               inputFileFiledNodes[i].setAttribute("name", "img_" + parseInt(i + 1));
           }*/
    });
</script>
<style>
    .btn-add-input-field {
        border: 1px solid #cdcdcd;
        padding: 10px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>
</body>
</html>
