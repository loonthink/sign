<template>
    <div id="form">
        <form action="http://localhost:88/sign/datasPhp/progress.login.php" method="post">
            <input type="text" name="name" /> <br /><br />
            <input type="password" name="pass" /> <br /> <br />
            <input type="text" hidden name="type" value="login">
            <input type="submit" value="提交">
        </form>
    </div>
</template>
