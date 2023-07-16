1. After Starting the project you would need to run migrations. 
`php yii migrate` 
2. First you would need to create User Types. you would need to send request on this endpoint: 
`user-type/create` . name field must be filled.
3. Then you would need to create service on this endpoint: `service/create`. name field must be filled as well.
4. Then you can register user. Before registering user you must need to have user-type created.
`/auth/create` 'name, email, password and user_category_id must be filled. 
5. Then you would need to log in on the website. `login` on this endpoint. With name and email.
6. Then if you would like to book a service you would need to send request on this endpoint
`/booking/create` with user_id service_id date and address. 

but you would need to copy token that was generated when you loged in and send this token in header as well. 

Thanks. 