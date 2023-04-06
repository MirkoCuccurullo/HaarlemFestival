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
    </script>

</div>

<?php
include __DIR__ . '/../footer.php'; ?>
