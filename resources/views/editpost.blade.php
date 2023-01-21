<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Edit Post</title>

    <script src="https://cdn.tiny.cloud/1/uqqyka97d4c626a059j4cvc0j6yw5nknj1tdjy1i30l20nuh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <div class="container">
        <div class="row align-items-center d-flex justify-content-center" style="min-height: 100vh">
            <div class="col-md-10">
                <form action="api/posts" method="POST">
                    <h3>Назва</h3>
                    <input type="text" class="form-control" id="postname" name="name" placeholder="Новина">
                    <h3>Короткий опис</h3>
                    <input type="text" class="form-control" id="postdescription" name="description" placeholder="В цьому пості ви хочете описати...">
                    <h3>Текст поста</h3>
                    <textarea id="postbody" name="body">
                        Welcome to TinyMCE!
                    </textarea>
                    <script>
                        tinymce.init({
                            selector: '#postbody',
                            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                            tinycomments_mode: 'embedded',
                            tinycomments_author: 'Author name',
                        });
                    </script>
                    <button type="submit" id="postbutton" class="btn btn-primary">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>