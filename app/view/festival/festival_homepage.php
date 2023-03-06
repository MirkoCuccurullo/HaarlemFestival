<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/q0czso0c6q6ut003t5rj8pm8r2bqy0uo2z23wjdtmavywsxz/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <title>Index</title>
</head>

<div id="card-container2" class="row">
    <script>
        function appendCard(item){
            const cardContainer = document.getElementById('card-container2');

            const container = document.createElement('div');
            container.className = 'col-md-6 my-3';
            container.style = 'display: flex; justify-content: center; background-color: #f5f5f5';
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
            prompt.outerHTML = item.prompt; //maybe modify the column name to something else

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
            fetch('/api/homeCards')
                .then(result => result.json())
                .then((cards)=>{
                    cards.forEach(item => {
                        appendCard(item);
                    })
                })
        }
        loadCards();
    </script>

</div>

<script>
    function sendEditForm(numericId) {
        //const numericId = formId.substring(4);

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

        removeCards();
        loadCards();
    }

    function edit(buttonId) {
        //alert(buttonId);
        const editBtn = document.getElementById(buttonId);
        editBtn.remove();
        const numericId = buttonId.substring(3);
        const card = document.getElementById(numericId);
        const html = card.innerHTML;


        const textarea = document.createElement('textarea');
        textarea.id = 'textarea' + numericId;
        textarea.name = 'content';
        textarea.innerHTML = html;
        card.parentNode.replaceChild(textarea, card);

        const div = document.getElementById('div' + numericId);
        const saveButton = document.createElement('button');
        //saveButton.type = 'submit';
        saveButton.className = 'btn-primary';
        saveButton.innerHTML = 'Save';
        saveButton.name = 'save';

        const cancelButton = document.createElement('button');
        cancelButton.type = 'button';
        cancelButton.className = 'btn-danger';
        cancelButton.innerHTML = 'Cancel';


        cancelButton.onclick = function () {
            textarea.parentNode.replaceChild(card, textarea);
            cancelButton.remove();
            saveButton.remove();
            card.appendChild(editBtn);
            const tinymceEditor = tinymce.get('textarea' + numericId);
            tinymceEditor.remove(tinymceEditor);
        }

        saveButton.onclick = function () {
            sendEditForm(numericId);

            textarea.parentNode.replaceChild(card, textarea);
            cancelButton.remove();
            saveButton.remove();
            card.appendChild(editBtn);
            const tinymceEditor = tinymce.get('textarea' + numericId);
            tinymceEditor.remove(tinymceEditor);
            //removeCards();
            //loadCards();
        }

        div.appendChild(saveButton);
        div.appendChild(cancelButton);

        tinymce.init({
            selector: '#textarea' + numericId,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                {value: 'First.Name', title: 'First Name'},
                {value: 'Email', title: 'Email'},
            ]
        });
    }

    function removeCards(){
        const cardContainer = document.getElementById('card-container2');
        while (cardContainer.firstChild) {
            cardContainer.removeChild(cardContainer.firstChild);
        }
    }
</script>

<h1>Add card</h1>
<form onsubmit="addCard();return false">
    <div>
       <textarea required name="editor" id="editor">
        Welcome to TinyMCE!
       </textarea>

        <input type="submit" class="btn-primary mx-auto mt-3" name="submit" value="Submit card"/>
    </div>
</form>

<script>
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

        //removeCards();
        //loadCards();
        //alert(heading + paragraph + link + image);
    }

    function getHeading(doc) {
        //return doc.querySelector("h1, h2, h3, h4, h5, h6").outerHTML;
        return doc.querySelector("h1, h2, h3, h4, h5, h6");
    }

    function getParagraph(doc) {
        //return doc.querySelector("p:not(:has(*))").outerHTML;
        return doc.querySelector("p:not(:has(*))");
        //return doc.querySelector("p").outerHTML;
    }

    function getLink(doc) {
        //return doc.querySelector("a").outerHTML;
        return doc.querySelector("a");
    }

    function getImage(doc) {
        //return doc.querySelector("img").outerHTML;
        return doc.querySelector("img");
    }
</script>


<script>
    tinymce.init({
        selector: '#editor',
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


<br>

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
