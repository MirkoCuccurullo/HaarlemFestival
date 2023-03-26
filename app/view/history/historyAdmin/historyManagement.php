<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="/css/historyManagement.css" rel="stylesheet">
    <title>CRUD</title>
</head>
<body>

<div class="container1">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight" id="header"><h2>Location Card Management</div>
        <button type="button" style="background-color: #3D1A78">
            <a href="/historyManagement/add" style="color:white; text-decoration:none;">Add Content</a>
        </button>
        <button type="button" name="update" style="background-color: #3D1A78; margin-left: 10px; color: white" >
            Update Content
        </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Content</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="mytable">
            <?php if(isset($locations)) foreach ($locations as $location) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <input type="hidden" name="id" value="<?= $location->id ?>">
                        <td name="id" contenteditable="false"><?= $location->id ?></td>
                        <td name="id" contenteditable="true"><input type="text" name="title" value="<?= $location->title ?>"></td>
                        <td name="id" contenteditable="true"><input type="text" name="image" value="<?= $location->image ?>"></td>
                        <td name="id" contenteditable="true"><input type="text" name="content" value="<?= $location->content ?>"></td>
                        <td>
                            <button type="submit" name="update"><i class="fas fa-edit"></i></button>
                        </td>
                    </form>
                    <td>
                        <form action="/historyManagement" method="POST">
                            <input type="hidden" name="id" value="<?php echo $location->id ?>">
                            <button type="submit" name="delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>

<div class="container2" style=" margin-top: 30px">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight" id="header"><h2>Schedule Management</div>
        <button type="button" style="background-color: #3D1A78">
            <a href="/historyManagement/add" style="color:white; text-decoration:none;">Add Content</a>
        </button>
        <button type="button" name="update" style="background-color: #3D1A78; margin-left: 10px; color: white" >
            Update Content
        </button>
    </div>

    <div class="table-container" style="height: 400px; overflow-y: scroll;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Day and Date</th>
                <th scope="col">Time</th>
                <th scope="col">Language</th>
                <th scope="col">Ticket Amount</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="mytable">
            <?php if(isset($historyTourTimetable)) foreach ($historyTourTimetable as $timetable) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <input type="hidden" name="id" value="<?= $timetable['id'] ?>">
                        <td name="id" contenteditable="false"><?= $timetable['id'] ?></td>
                        <td name="dateAndDay" contenteditable="true"><input type="text" name="title" value="<?= $timetable['dateAndDay']; ?>"></td>
                        <td name="time" contenteditable="true"><input type="text" name="image" value="<?= $timetable['time']; ?>"></td>
                        <td name="language" contenteditable="true"><input type="text" name="content" value="<?= $timetable['language']; ?>"></td>
                        <td name="ticketAmount" contenteditable="true"><input type="text" name="content" value="<?= $timetable['ticketAmount']; ?>"></td>
                        <td>
                            <button type="submit" name="update"><i class="fas fa-edit"></i></button>
                        </td>
                    </form>
                    <td>
                        <form action="/historyManagement" method="POST">
                            <input type="hidden" name="id" value="<?php echo $timetable['id'] ?>">
                            <button type="submit" name="delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>

</body>
</html>

