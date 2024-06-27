<?php
session_start();

require "../database/database.php";

$messageError ="";

if (isset($_SESSION['empleado_id'])) {

    header('Location: ../pages/productos.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['num']) && !empty($_POST['password'])) {

    $records = $conn->prepare('SELECT * FROM empleados WHERE numero = :num');
    $records->bindParam(':num', $_POST['num']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (is_array($results) && count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['empleado_id'] = $results['id'];
        $_SESSION['userName'] = $results['nombre'];
        $_SESSION['numeroEmpleado'] = $results['numero'];
        header('Location: ../pages/productos.php');
    } else {
        $messageError = 'Sorry, those credentials do not match';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmaceutica</title>
    <script src="../js/tailwind.js"></script>
</head>

<body class="w-full h-screen overflow-hidden">

    <nav id="contMenu" class="w-full h-24 min-w-96 bg-slate-900 flex justify-between items-center px-10 shadow-2xl fixed">
        <div id="logo" class="w-1/4 flex justify-start items-center">
            <img src="../img/logo.png" class="w-20">
            <h1 class="text-white">BioNova Pharma</h1>
        </div>
    </nav>
    <section id="main" class="h-screen flex">

        <img class="w-1/2" src="../img/login.png" alt="">
        <div class="w-1/2 w-screen bg-slate-800 flex justify-center items-center">

            <form method="post" class="w-full h-2/3 flex flex-col justify-center items-center">

                <svg class="w-96" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path opacity="0.5" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#94a3b8"></path>
                        <path d="M16.807 19.0112C15.4398 19.9504 13.7841 20.5 12 20.5C10.2159 20.5 8.56023 19.9503 7.193 19.0111C6.58915 18.5963 6.33109 17.8062 6.68219 17.1632C7.41001 15.8302 8.90973 15 12 15C15.0903 15 16.59 15.8303 17.3178 17.1632C17.6689 17.8062 17.4108 18.5964 16.807 19.0112Z" fill="#94a3b8"></path>
                        <path d="M12 12C13.6569 12 15 10.6569 15 9C15 7.34315 13.6569 6 12 6C10.3432 6 9.00004 7.34315 9.00004 9C9.00004 10.6569 10.3432 12 12 12Z" fill="#94a3b8"></path>
                    </g>
                </svg>
                <div class="flex flex-col gap-3">
                    <label for="num" class="text-white">Numero de Empleado:</label>
                    <?php echo $messageError; ?>
                    <input name="num" type="text" id="num" class="w-72 h-10 outline-0 rounded px-5 bg-slate-300" placeholder="Numero Empleado" required />

                    <label for="pass" class="text-white">Contraseña:</label>
                    <input name="password" type="password" id="pass" class="w-72 h-10 outline-0 rounded px-5 bg-slate-300" placeholder="Contraseña" required />

                    <input type="submit" class="p-5 bg-slate-300 rounded-2xl mt-4">

                    <p class="text-blue-200" >aun no tienes una cuenta <a href="./register.php" class="text-blue-400">Registrate</a></p>
                </div>

            </form>

        </div>
    </section>
</body>

</html>