<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/q0czso0c6q6ut003t5rj8pm8r2bqy0uo2z23wjdtmavywsxz/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <title>Index</title>
</head>


<div id="card-container">
    <?php
    foreach ($homePage as $item): ?>
        <form onsubmit="sendEditForm(this.id);return false" id="form<?= $item['id'] ?>">
            <input type="hidden" name="editId" value="<?= $item['id'] ?>" id="edit<?= $item['id'] ?>">
            <div class="card" id="<?= $item['id'] ?>">
                <?php
                echo htmlspecialchars_decode($item['image']);
                echo htmlspecialchars_decode($item['title']);
                echo htmlspecialchars_decode($item['content']);
                echo htmlspecialchars_decode($item['prompt']);
                ?>

            </div>
        </form>
        <button class='btn-primary' onclick='edit(this.id)' id="btn<?= $item['id'] ?>">Edit</button>
    <?php endforeach; ?>
</div>

<script>
    function sendEditForm(formId) {
        const numericId = formId.substring(4);

        const content = tinymce.get('textarea' + numericId).getContent();
        const parser = new DOMParser();
        const doc = parser.parseFromString(content, "text/html");

        const heading = getHeading(doc);
        //heading.className = 'card-title';
        const paragraph = getParagraph(doc);
        //paragraph.className = 'card-text';
        const link = getLink(doc);
        //link.className = 'btn-primary';
        const image = getImage(doc);
        //image.className = 'card-img-top';

        const obj = {id: numericId, heading: heading, paragraph: paragraph, link: link, image: image};

        fetch('/api/homeCards/update', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(obj),
        }).then(result => {
            console.log(result)
        });
    }

    function edit(buttonId) {
        //alert(buttonId);
        const newId = buttonId.substring(3);
        const card = document.getElementById(newId);
        const html = card.innerHTML;

        const textarea = document.createElement('textarea');
        textarea.id = 'textarea' + newId;
        textarea.name = 'content';
        textarea.innerHTML = html;
        card.parentNode.replaceChild(textarea, card);

        const form = document.getElementById('form' + newId);
        const saveButton = document.createElement('button');
        saveButton.type = 'submit';
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
            const tinymceEditor = tinymce.get('textarea' + newId);
            tinymceEditor.remove(tinymceEditor);
        }

        form.appendChild(saveButton);
        form.appendChild(cancelButton);

        tinymce.init({
            selector: '#textarea' + newId,
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
</script>
<!--<div id="card-container">-->
<!--    <script>-->
<!--        function appendHomeCard(homeCard){-->
<!--            const cardContainer = document.getElementById('card-container');-->
<!--            const card = document.createElement('div');-->
<!--            const cardImg = document.createElement('img');-->
<!--            const cardBody = document.createElement('div');-->
<!--            const cardP = document.createElement('p');-->
<!--            const cardBtn = document.createElement('button');-->
<!---->
<!--            card.className = 'card';-->
<!--            cardImg.className = 'card-img-top';-->
<!--            cardBody.className = 'card-body';-->
<!--            cardP.className = 'card-text';-->
<!--            cardBtn.className = 'btn-primary';-->
<!---->
<!--            //cardP.innerHTML = homeCard.content;-->
<!--            //cardBody.appendChild(cardP);-->
<!--            cardBody.appendChild(cardBtn);-->
<!--            card.appendChild(cardImg);-->
<!--            card.appendChild(cardBody);-->
<!--            cardContainer.appendChild(card);-->
<!--        }-->
<!---->
<!--        function getHomeCards(){-->
<!--            fetch('/api/homeCards')-->
<!--                .then(result => result.json())-->
<!--                .then((cards)=>{-->
<!--                    cards.forEach(homeCard => {-->
<!--                        appendHomeCard(homeCard);-->
<!--                    })-->
<!--                    console.log(cards);-->
<!--                })-->
<!--        }-->
<!---->
<!--        getHomeCards();-->
<!--    </script>-->
<!--</div>-->


<h1>Edit Article</h1>
<form onsubmit="bruh();return false">
    <div>
       <textarea required name="editor" id="editor">
        Welcome to TinyMCE!
       </textarea>

        <input type="submit" name="submit" value="Submit page"/>
    </div>
</form>

<button name="submit" value="Submit" onclick="bruh()">Submit</button>
<script>
    function bruh() {
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


<?php
include __DIR__ . '/../footer.php'; ?>
