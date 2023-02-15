<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Doctors</h1>
<a href="/management/addDoctor" class="btn btn-primary mb-3">Add doctor</a>
<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date of birth</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Role</th>
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="userTable">

        <script>
            function loadDoctors() {
                fetch('http://localhost/api/users')
                    .then(result => result.json())
                    .then((users)=>{
                        users.forEach(user => {
                            appendDoctor(user);
                        })
                        console.log(user);
                    })
            }

            function appendDoctor(user)
            {
                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const nameCol = document.createElement("td");
                const emailCol = document.createElement("td");
                const dateOfBirthCol = document.createElement("td");
                const roleCol = document.createElement("td");
                const regDateCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deleteButton = document.createElement("button")
                const editButton = document.createElement("button")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.method = "POST";
                editForm.action = "/management/editDoctor";

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "doctorId";
                idInput.value = user.id;
                idCol.innerHTML = user.id;
                nameCol.innerHTML = user.name;
                roleCol.innerHTML = user.role;
                emailCol.innerHTML = user.email;
                dateOfBirthCol.innerHTML = user.date_of_birth;
                regDateCol.innerHTML = user.registration_date;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";

                deleteButton.addEventListener('click', function ()
                {
                    deleteDoctor(user.id);
                    table.removeChild(newRow);
                })

                editForm.appendChild(editButton);
                editForm.appendChild(idInput);

                deleteButtonCol.appendChild(deleteButton);
                editButtonCol.appendChild(editForm);


                newRow.appendChild(idCol);
                newRow.appendChild(nameCol);
                newRow.appendChild(roleCol);
                newRow.appendChild(emailCol);
                newRow.appendChild(dateOfBirthCol);
                newRow.appendChild(regDateCol);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);

                const table = document.getElementById("userTable");
                table.appendChild(newRow);
            }

            function deleteDoctor(doctorId) {

                const obj = {id: doctorId};
                fetch('http://localhost/api/doctors', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(obj),
                }).then(result => {
                    console.log(result)
                });
            }

            loadDoctors();
        </script>
        </tbody>
    </table>
</div>

<?php
include __DIR__ . '/../footer.php'; ?>



