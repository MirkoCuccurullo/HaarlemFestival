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
        <div class="me-auto p-2 bd-highlight" id="header" style="color: #3D1A78"><h2>Location Card Management</div>
        <div class="error" > <span id="update-msg"> <?=$updateCardMessage?> </span> </div><br>
        <div class="error" > <span id="update-msg"> <?=$deleteCardMessage?> </span> </div><br>
        <div class="error" > <span id="update-msg"> <?=$addCardMessage?> </span> </div><br>
        <button type="button" style="background-color: #3D1A78">
            <a href="/historyManagement/add" style="color:white; text-decoration:none;">Add Card Content</a>
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
            <?php foreach ($locations as $location) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <input type="hidden" name="id" value="<?= $location->id ?>">
                        <td name="id"> <?= $location->id ?></td>
                        <td name="id"> <input type="text" name="title" value="<?= $location->title ?>" required></td>
                        <td name="id"> <input type="text" name="image" value="<?= $location->image ?>" required></td>
                        <td name="id"> <input type="text" name="content" value="<?= $location->content ?>" required></td>
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

<div class="container2" style=" margin-top: 70px; color: #3D1A78">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight" id="header"><h2>Schedule Management</div>
        <div class="error" > <span id="update-msg"> <?=$updateSchedule?> </span> </div><br>
        <div class="error" > <span id="update-msg"> <?=$deleteScheduleMessage?> </span>  </div><br>
        <div class="error" > <span id="update-msg"> <?=$addScheduleMessage?> </span></div><br>

        <button type="button" style="background-color: #3D1A78">
            <a href="/historyManagement/addScheduleContent" style="color:white; text-decoration:none;">Add Schedule Content</a>
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
                <th scope="col">Price (€) per ticket</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="mytable">
            <?php foreach ($historyTourTimetable as $timetable) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <input type="hidden" name="id" value="<?= $timetable['id'] ?>">
                        <td name="id"> <?= $timetable['id'] ?></td>
                        <td name="dateAndDay"> <input type="text" name="dateAndDay" value="<?= $timetable['dateAndDay']; ?>"></td>
                        <td name="time"> <input type="text" name="time" value="<?= $timetable['time']; ?>"></td>
                        <td name="language"> <input type="text" name="language" value="<?= $timetable['language']; ?>"></td>
                        <td name="ticketAmount"> <input type="text" name="ticketAmount" value="<?= $timetable['ticketAmount']; ?>"></td>
                        <td name="price"><input type="text" name="price" value="<?= $timetable['price']; ?>"></td>
                        <td>
                            <button type="submit" name="updateSchedule"><i class="fas fa-edit"></i></button>
                        </td>
                    </form>
                    <td>
                        <form action="/historyManagement" method="POST">
                            <input type="hidden" name="tableId" value="<?php echo $timetable['id'] ?>">
                            <button type="submit" name="deleteSchedule"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>


<div class="container2" style=" margin-top: 70px; color: #3D1A78">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight" id="header"><h2>Main Content Management</div>
        <div class="error" > <span id="update-msg"> <?=$updateMainContentMessage?> </span> </div><br>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Main Image Header</th>
                <th scope="col">Tour Card Header</th>
                <th scope="col">Tour Card Paragraph</th>
                <th scope="col">Tour Card Button Text</th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody id="mytable">
            <?php foreach ($content as $c) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <input type="hidden" name="id" value="<?= $c->id ?>">
                        <td name="id"> <?= $c->id ?></td>
                        <td name="mainImageHeader"> <input type="text" name="mainImageHeader" value="<?= $c->mainImageHeader ?>"></td>
                        <td name="tourCardHeader"> <input type="text" name="tourCardHeader" value="<?= $c->tourCardHeader ?>"></td>
                        <td name="tourCardParagraph"> <input type="text" name="tourCardParagraph" value="<?= $c->tourCardParagraph ?>"></td>
                        <td name="tourCardButtonText"> <input type="text" name="tourCardButtonText" value="<?= $c->tourCardButtonText ?>"></td>
                        <td>
                            <button type="submit" name="updateMainContent"><i class="fas fa-edit"></i></button>
                        </td>
                    </form>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>

</body>
</html>

<?php include __DIR__ . '/../../footer_history.php'; ?>

