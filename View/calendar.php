<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../project/css/calendar.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js'></script>
    <script src="../project/jquery.js"></script>
    <script>
        const diaries = <?php echo json_encode($diary); ?>;
    </script>
    <script src="../project/script.js"></script>
    <style>
        td{
            height: 6em!important;
        }
        p{
            margin-bottom: 0!important;
        }
        .list-diary{
            height: 4em!important;
        }
    </style>
</head>
<body>
    <?php require_once "navbar.php"?>
    <div class="calendar mb-3">
        <div class="row text-center mb-2">
            <div class="col mb-01 h3">Calendar</div>
        </div>       
        <div class="row calendar-head">
            <div class="col-2">
                <button id="prev-button">&lt;</button>
            </div>
            <div class="col-8 monthYear">
                <h4 id="month" style="margin: 0;">April</h4>
                <select class="year-option" id="year">
                    <option id="currentYear" value="2025">2025</option>              
                </select>
            </div>
            <div class="col-2">
                <button id="next-button">&gt;</button>
            </div>
        </div>
        <div id="calendar">
        </div>
    </div>

    <div class="container-fluid collapse info-show" id="info-show">
        <div class="row my-2">
            <div class="col"><button type="button" class="btn-close" data-toggle="collapse" data-target="#info-show" aria-controls="info-show" aria-expanded="false" aria-label="close information"></button></div>
        </div>
        <div class="row">
            <div class="col"><p class="selectedDate"></p></div>
        </div>
        <div class="row">
            <div class="col"><h3>Catatan</h3></div>
        </div>      
        <div class="list-container">
        </div>  
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>