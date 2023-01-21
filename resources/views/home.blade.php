<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Home</title>
</head>

<body>
    @csrf
    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom">api.minecraftrevolution</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#collection" />
                    </svg>
                </div>
                <h3 class="fs-2">Пости</h3>
                <a href="/editpost" class="icon-link d-inline-flex align-items-center">
                    Подивитись
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </a>
                <a href="/api/posts/9/edit" class="btn btn-primary">Edit Post</a>
            </div>
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#people-circle" />
                    </svg>
                </div>
                <h3 class="fs-2">Юзери</h3>
                <a href="#" class="icon-link d-inline-flex align-items-center">
                    Подивитись
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </a>
            </div>
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#toggles2" />
                    </svg>
                </div>
                <h3 class="fs-2">Сервери</h3>
                <a href="#" class="icon-link d-inline-flex align-items-center">
                    Подивитись
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>

</html>