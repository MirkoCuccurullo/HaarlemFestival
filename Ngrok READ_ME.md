## Link to website

[The Festival](https://thefestival-it2a-gr04.000webhostapp.com/)


## Admin Credentials
- Email: mirkocuccurullo@outlook.com
- Password: 1234


## Employee Credentials
- Email: rares.simion08@gmail.com
- Password: 1234


To run the image on docker run 

```sh
docker compose build
```

then 


```sh
docker compose up
```

In order to user the Mollie Payment API on localhost, Ngrok is needed. Download it [here](https://ngrok.com/download). 

Once installed, run the ngrok.exe executable and enter:
```sh
ngrok config add-authtoken 2NQXbk2XqfwW1ZHBoP4rps18uOE_7DWmdvqbtqSNrQ45nzCZA
```

After adding the token, run the following command:
```sh
ngrok.exe http localhost
```

After running the command, copy the forwarding link found in the terminal(without localhost).
```sh
Forwarding                    
https://f3d9-85-149-137-48.ngrok-free.app -> http://localhost:80
```

Finally, replace the webhook link with the copied link in the app/service/MollieService.php 
```sh
"webhookUrl" => "https://f3d9-85-149-137-48.ngrok-free.app/webhook",
```





