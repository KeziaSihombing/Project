<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/navbar.css">
</head>
<body>
    <section id="container">
        <nav class="navbar navbar-expand-sm">
          <div class="container-fluid">
              <a class="navbar-brand" href="index.php"><img src="./images/Frame 5.png"/></a>
              <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">       
                <span class="navbar-toggler-icon"><img src="./images/Menu.png"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav navbar-nav navbar-left">
                <li class="nav-item active"><a href="index.php?c=Calendar&m=landingPage">Home</a></li>
                <li class="nav-item"><a href="index.php?c=Calendar&m=calendar">Calendar</a></li>
                <li class="nav-item"><a href="#">Cat Diary</a></li>
                <li class="nav-item"><a href="#">Profile</a></li>
                <li class="nav-item logout"><a href="#">Log Out</a></li>
              </ul>
            </div>
          </div>
        </nav>
    </section> 
</body>
</html>