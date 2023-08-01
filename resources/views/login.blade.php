<h1>Login Form<h1>
<form action="user" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Input user name"><br><br>
    <input type="text" name="userpassword" placeholder="Input password"><br><br>
    <button type="submit">Login</button>
</form>
