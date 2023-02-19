<?php
include('editor.php');
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/q0czso0c6q6ut003t5rj8pm8r2bqy0uo2z23wjdtmavywsxz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Index</title>
</head>
<?php
foreach ($home as $article) {
    $html_content = htmlspecialchars_decode($article['content']);
    echo "<div class='card' style='width: 18rem;'>$html_content</div>";
}
?>
<h1>Edit Article</h1>
<form action="/home/editor" method="post">
    <div>
       <textarea required name="editor" id="editor">
        Welcome to TinyMCE!
       </textarea>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                    {value: 'First.Name', title: 'First Name'},
                    {value: 'Email', title: 'Email'},
                ]
            });
        </script>
        <input type="submit" name="submit" value="Submit"/>
    </div>
</form>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">History Tours in Haarlem</h5>
        <p class="card-text">Explore the historical sites of Haarlem. It is one of the oldest cities of the Netherlands,
            dating back to the 10th century. Join the history events taking place in Haarlem. These events are geared
            towards everyone, whether they are history enthusiasts, researchers, historians, families, and so forth.
            Visit us and broaden your horizons.
        </p>
        <br>
        <a href="#" class="btn-primary">History</a>
    </div>
</div>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Music clubs in Haarlem</h5>
        <p class="card-text">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot
            the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in Haarlem
            it is possible to find the right event for every musical taste, from blues to techno.
        </p>
        <br>
        <a href="#" class="btn-primary">Music</a>
    </div>
</div>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Kids events in Haarlem</h5>
        <p class="card-text">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot
            the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in Haarlem
            it is possible to find the right event for every musical taste, from blues to techno.
        </p>
        <br>
        <a href="#" class="btn-primary">Kids</a>
    </div>
</div>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Culinary events in Haarlem</h5>
        <p class="card-text">Haarlem is a young, bold and very alive city, the vicinity with Amsterdam influences a lot
            the musical culture of the people here, altough the dimension are smaller as the Dutch capital, in Haarlem
            is possible to find the right event for every musical taste, from blues to techno.
        </p>
        <br>
        <a href="#" class="btn-primary">Culinary</a>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php'; ?>
