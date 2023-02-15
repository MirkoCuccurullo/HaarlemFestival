<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Users</h1>
<select name="role" id="role" class="form-select" oninput="filterUsers()">
    <option selected value="0"> All Roles</option>
    <option value="Employee">Employee</option>
    <option value="Customer">Customer</option>
    <option value="Administrator">Administrator</option>
</select>

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
            function filterUsers(){
                const role = document.getElementById("role").value;
                const table = document.getElementById("userTable");
                const rows = table.getElementsByTagName("tr");
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const roleCol = row.getElementsByTagName("td")[4];
                    if (roleCol) {
                        const roleValue = roleCol.textContent || roleCol.innerText;
                        if (role === "0" || roleValue === role) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                }
            }
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
                editForm.action = "/edit/user";

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "id";
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
                newRow.appendChild(emailCol);
                newRow.appendChild(dateOfBirthCol);
                newRow.appendChild(regDateCol);
                newRow.appendChild(roleCol);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);

                const table = document.getElementById("userTable");
                table.appendChild(newRow);
            }

            function deleteDoctor(userId) {

                const obj = {id: userId};
                fetch('http://localhost/api/delete/user', {
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



