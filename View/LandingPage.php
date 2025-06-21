<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
     <link rel="stylesheet" href="./css/LandingPage.css"> 
</head>
<body>
    <?php require_once "navbar.php"?>
    
    <div class="d-flex flex-column text-center align-items-center main">
        <div>
            <h1 class="display-1">Simplify <span style="color: #F59245">Cat Care</span> Strengthen Your Bond.</h1>
        </div>
        <div class="p-2">
            <p class="display-6">Manage your cat’s, track their daily activities, and connect with fellow pet owners—all in one place.</p>
        </div>
        <div class="p-2">
            <button class="diary-button">See Diary</button>
        </div>
    </div>
    <div class="cat-fact d-flex flex-column justify-content-center align-items-center pt-">
        <div class="mb-2">
            <img src="./images/bro.png" class="cat-photo">
        </div>
        <div class="mb-2 text-center">
            <h2 style="color: #F59245">Cat Fact</h2>
            <p>A collection of daily fact about Cat.</p>
        </div>    
        <button class="fact-button">See Cat Fact</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>
</html>