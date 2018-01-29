<?php
foreach($errors as $error){
    echo $error;
    echo "<br >";
}

?>
<form method="post" action="/new-framework/adduser">

<input type="text" name="username" placeholder="Username"/><br/><br>
<select name="role">
<option disablbed>SELECT A ROLE</option>
<option value="Admin">ADMIN</option>
<option value="WORKER">WORKER</option>
</select><br/><br >
<input type="password" name="password" placeholder=""><br/> <br/>

<button type="submit" name="submit">SUBMIT</button>
</form>