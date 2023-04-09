<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/ea8dl2qwcc0ubif5iugpqvomh1a1ftv5skra68xzeys1qabb/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <title>Index</title>
</head>

<div class="container text-center">
    <h1 style="font-size: 5em">THE FESTIVAL</h1>
    <h2>27th to 30th July in Haarlem</h2>
    <br>
    <h2>Check out our selected events for this year’s Haarlem Festival!</h2>
</div>
<div id="card-container2" class="row">
    <script>
        function changeBannerImage(){
            const imageInput = document.getElementById('banner-image-input');
            imageInput.src = 'images/festival-homepage.png'
        }

        changeBannerImage();
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

            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger mt-3';
            deleteButton.id = 'deleteBtn' + item.id;
            deleteButton.onclick = function () {
                deleteCard(this.id);
            };
            deleteButton.innerText = 'Delete';
            card.appendChild(deleteButton);

            const editButton = document.createElement('button');
            editButton.className = 'btn-primary mt-3';
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
            fetch('/api/festivalCards',{
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(result => result.json())
                .then((cards)=>{
                    cards.forEach(item => {
                        appendCard(item);
                    })
                }).
                catch((error)=>{
                    console.log(error);
                })
        }

        loadCards();

        function deleteCard(id){
            const numericId = id.substring(9);
            const obj = { id: numericId };
            fetch('/api/festivalCards', {
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

        fetch('/api/festivalCards', {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(obj),
        }).then(result => {
            console.log(result)
        });
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
        saveButton.className = 'btn btn-primary';
        saveButton.innerHTML = 'Save';
        saveButton.name = 'save';

        const cancelButton = document.createElement('button');
        cancelButton.type = 'button';
        cancelButton.className = 'btn btn-danger';
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
            sendEditForm(numericId);
            div.className = 'col-md-6 my-3';
            textarea.parentNode.replaceChild(card, textarea);
            cancelButton.remove();
            saveButton.remove();
            card.appendChild(deleteBtn);
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

<button class="btn-primary" onclick="displayEditor()">Add card</button>
<button class="btn-danger" onclick="hideEditor()" id="addCardCancelButton" hidden>Cancel</button>

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

        fetch('/api/festivalCards', {
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

<?php
include __DIR__ . '/../footer.php'; ?>
