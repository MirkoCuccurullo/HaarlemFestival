<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/ea8dl2qwcc0ubif5iugpqvomh1a1ftv5skra68xzeys1qabb/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <title>Index</title>
</head>
<div class="row">
    <div class="col md-6">
        <h3 class="about-header">About Haarlem</h3>
        <p>Haarlem is a lovely historical city at no more than 20 km distance from Amsterdam.
            International and Inclusive tourism seems to have recognized Haarlem’s many delights,
            and an ever-increasing number of visitors find their path here each year.
            Haarlem offers a wide range of activities from visiting museums, shopping centers, bars, restaurants, art
            galleries, parks, and many more.
        </p>
    </div>
    <div class="col md-6">
        <h3 class="about-header">About Events</h3>
        <p>Inclusiveness is the constituent for creating this website. We are dedicated to promoting the splendid city
            of Haarlem to
            a wider audience and spreading awareness of inclusion and diversity. Different categories of events
            including history, music, and culinary will be ongoing to draw a
            versatile crowd to experience all Haarlem has to offer. There are also activities for the Kids coming in
            with their families.
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-body text-center">
            <h1 class="mb-3"><strong>The Festival</strong></h1>
            <img src="images/festival-card.png" alt="festival-card" style="width: 640px; height: 400px">
            <div class="mt-4" style="margin-left: 10em; margin-right: 10em">
                <p>The Festival, will be held on four days over the summer, in July, it is meant for any kind of person,
                    of any culture. The four main points of the event are, <strong>DANCE!</strong>, a electronic music
                    festival, where
                    the most famous DJ´s will perform, <strong>YUMMY!</strong>, a food festival, <strong>History
                        tour</strong> through the city and <strong>The
                        Secret of Dr. Teyler</strong>, a treasure hunt event for kids and families.
                </p>
            </div>

            <a type="button" href="/festival" class="btn btn-primary" >Explore events</a>

        </div>
    </div>
</div>
<div id="card-container2" class="row">
    <script>
        function appendCard(item){
            const cardContainer = document.getElementById('card-container2');

            const container = document.createElement('div');
            container.className = 'col-md-6 my-3';
            container.style = 'display: flex; justify-content: center;';
            container.id = 'div' + item.id;

            const card = document.createElement('div');
            card.className = 'card card-body';
            card.id = item.id;

            const image = document.createElement('img');
            card.appendChild(image);
            image.outerHTML = item.image;

            const title = document.createElement('h1');
            card.appendChild(title);
            title.outerHTML = item.title;

            const content = document.createElement('p');
            card.appendChild(content);
            content.outerHTML = item.content;

            const prompt = document.createElement('a');
            card.appendChild(prompt);
            prompt.outerHTML = item.prompt;
            prompt.className = 'btn btn-primary mt-3';

            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger mt-3';
            deleteButton.id = 'deleteBtn' + item.id;
            deleteButton.onclick = function () {
                deleteCard(this.id);
            };
            deleteButton.innerText = 'Delete';
            card.appendChild(deleteButton);

            const editButton = document.createElement('button');
            editButton.className = 'btn btn-primary mt-3';
            editButton.id = 'btn' + item.id;
            editButton.onclick = function () {
                edit(this.id);
            };
            editButton.innerText = 'Edit';
            card.appendChild(editButton);

            container.appendChild(card);

            cardContainer.appendChild(container);
        }

        function loadCards(){
            fetch('/api/homeCards')
                .then(result => result.json())
                .then((cards)=>{
                    cards.forEach(item => {
                        appendCard(item);
                    })
                })
        }
        loadCards();

        function deleteCard(id){
            const numericId = id.substring(9);
            const obj = { id: numericId };
            fetch('/api/homeCards', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(obj),
            }).then(result => {
                console.log(result)
            });
        }
    </script>

</div>

<script>
    function sendEditForm(numericId) {
        const content = tinymce.get('textarea' + numericId).getContent();
        const parser = new DOMParser();
        const doc = parser.parseFromString(content, "text/html");

        const heading = getHeading(doc);
        heading.classList.add('card-title');
        const paragraph = getParagraph(doc);
        paragraph.classList.add('card-text');
        const link = getLink(doc);
        link.classList.add('btn-primary');
        const image = getImage(doc);
        image.classList.add('card-img-top');

        const headingContent = heading.outerHTML;
        const paragraphContent = paragraph.outerHTML;
        const linkContent = link.outerHTML;
        const imageContent = image.outerHTML;

        const obj = {id: numericId, heading: headingContent, paragraph: paragraphContent, link: linkContent, image: imageContent};

        fetch('/api/homeCards/update', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(obj),
        }).then(result => {
            console.log(result)
        });

        loadCards();
    }

    function edit(buttonId) {
        const editBtn = document.getElementById(buttonId);
        editBtn.remove();
        const deleteBtn = document.getElementById('deleteBtn' + buttonId.substring(3));
        deleteBtn.remove();

        const numericId = buttonId.substring(3);
        const card = document.getElementById(numericId);
        const html = card.innerHTML;


        const textarea = document.createElement('textarea');
        textarea.id = 'textarea' + numericId;
        textarea.name = 'content';
        textarea.innerHTML = html;
        card.parentNode.replaceChild(textarea, card);

        const div = document.getElementById('div' + numericId);
        div.className = 'col-md-12 my-3';
        const saveButton = document.createElement('button');
        saveButton.className = 'btn-primary';
        saveButton.innerHTML = 'Save';
        saveButton.name = 'save';

        const cancelButton = document.createElement('button');
        cancelButton.type = 'button';
        cancelButton.className = 'btn-danger';
        cancelButton.innerHTML = 'Cancel';


        cancelButton.onclick = function () {
            div.className = 'col-md-6 my-3';
            textarea.parentNode.replaceChild(card, textarea);
            cancelButton.remove();
            saveButton.remove();
            card.appendChild(deleteBtn);
            card.appendChild(editBtn);

            const tinymceEditor = tinymce.get('textarea' + numericId);
            tinymceEditor.remove(tinymceEditor);
        }

        saveButton.onclick = function () {
            div.className = 'col-md-6 my-3';

            sendEditForm(numericId);
            textarea.parentNode.replaceChild(card, textarea);
            cancelButton.remove();
            saveButton.remove();
            card.appendChild(editBtn);
            const tinymceEditor = tinymce.get('textarea' + numericId);
            tinymceEditor.remove(tinymceEditor);
        }

        div.appendChild(saveButton);
        div.appendChild(cancelButton);

        tinymce.init({
            selector: '#textarea' + numericId,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                {value: 'First.Name', title: 'First Name'},
                {value: 'Email', title: 'Email'},
            ]
        });
    }
</script>

<button class="btn btn-primary" onclick="displayEditor()">Add card</button>
<button class="btn btn-danger" onclick="hideEditor()" id="addCardCancelButton" hidden>Cancel</button>

<div class="container" id="addCardContainer" hidden>
    <h1>Add card (follow image + header + paragraph + link template)</h1>
    <form onsubmit="addCard();return false">
        <div>
       <textarea required name="editor" id="editor">

       </textarea>

            <input type="submit" class="btn-primary mx-auto mt-3" name="submit" value="Submit card"/>
        </div>
    </form>
</div>

<script>
    function hideEditor(){
        const addCardContainer = document.getElementById('addCardContainer');
        addCardContainer.hidden = true;

        const cancelButton = document.getElementById('addCardCancelButton');
        cancelButton.hidden = true;

        tinymce.remove();
    }

    function displayEditor(){
        const addCardContainer = document.getElementById('addCardContainer');
        addCardContainer.hidden = false;

        const cancelButton = document.getElementById('addCardCancelButton');
        cancelButton.hidden = false;
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                {value: 'First.Name', title: 'First Name'},
                {value: 'Email', title: 'Email'},
            ]
        });
    }

    function addCard() {
        const content = tinymce.get('editor').getContent();
        const parser = new DOMParser();
        const doc = parser.parseFromString(content, "text/html");

        const heading = getHeading(doc);
        heading.classList.add('card-title');
        const paragraph = getParagraph(doc);
        paragraph.classList.add('card-text');
        const link = getLink(doc);
        link.classList.add('btn-primary');
        const image = getImage(doc);
        image.classList.add('card-img-top');

        const headingContent = heading.outerHTML;
        const paragraphContent = paragraph.outerHTML;
        const linkContent = link.outerHTML;
        const imageContent = image.outerHTML;


        const obj = {heading: headingContent, paragraph: paragraphContent, link: linkContent, image: imageContent};

        fetch('/api/homeCards', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(obj),
        }).then(result => {
            console.log(result)
        });
    }

    function getHeading(doc) {
        return doc.querySelector("h1, h2, h3, h4, h5, h6");
    }

    function getParagraph(doc) {
        return doc.querySelector("p:not(:has(*))");
    }

    function getLink(doc) {
        return doc.querySelector("a");
    }

    function getImage(doc) {
        return doc.querySelector("img");
    }

</script>


<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            {value: 'First.Name', title: 'First Name'},
            {value: 'Email', title: 'Email'},
        ]
    });
</script>


<br>
<div class="text-center mb-4">
    <h1 class="about-header">Explore our instagram page!</h1>
</div>
<div id="card-container">
    <br>
    <div id="instafeed-container"></div>
    <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
    <script type="text/javascript">
        var userFeed = new Instafeed({
            get: 'user',
            target: "instafeed-container",
            resolution: 'low_resolution',
            accessToken: 'IGQVJYQUI5MlBBVF9hZA3RzWHBPQWg4NUxURERaN3V5OHNKMkRuVUg5enhrMTNsYWdNMzdrb3dwLVZAPZAFE5V2dCaFE2R3gwT0ZA2VXlzbjVzR3I4MnY4NTRPZA2FfdUVSd3M3OFQzSE54ZAlpGQVE5a2JHNwZDZD',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" width="400"></a>'
        });
        userFeed.run();
    </script>


</div>

<?php
include __DIR__ . '/../footer.php'; ?>
