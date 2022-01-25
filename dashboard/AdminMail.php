<?php
    $query = "SELECT * FROM compras WHERE NoFactura = '$factura'";
    $result = $conexion->prepare($query);
    $result->execute();
            
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    /* DETALLES COMPRA */
    $query1 = "SELECT * FROM detallescompra WHERE NoFactura = '$factura' ORDER BY Categoria DESC";
    $result1 = $conexion->prepare($query1);
    $result1->execute();
            
    $data1= $result1->fetchAll(PDO::FETCH_ASSOC);


    /* PHPMailer USE & REQUIRE */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer;

try {
    //Server settings 
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'robenriquemejia@gmail.com';                     //SMTP username
    $mail->Password   = '123Motocross123';                               //SMTP password
    $mail->SMTPSecure = 'tls';         //Enable TLS encryption
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('robenriquemejia@gmail.com', 'Roberto Mejia');   //DESDE DONDE SE ENVIA
    $mail->addAddress('robenriquemejia@gmail.com');     //A QUIENES SE LES ENVIA
    $mail->addAddress('robenriquemejia@gmail.com');     //A QUIENES SE LES ENVIA

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'NUEVA COMPRA REALIZADA';

    foreach ($data as $dat) {
        $NoFactura = $dat['NoFactura'];
        $Comprador = $dat['Comprador'];
        $Sucursal = $dat['Sucursal'];
        $Fecha = $dat['Fecha'];
        $RTN = $dat['RTN'];
        $Identidad = $dat['Identidad'];
        $Nota = $dat['Nota'];
        $Subtotal = $dat['Subtotal'];
        $ISV = $dat['ISV'];
        $Total = $dat['Total'];
    }

    $dynTable = '<tr>';

    foreach ($data1 as $data1) {
        $dynTable .= '<td>' . $data1['Categoria'] . '</td>' . '<td>' . $data1['Producto'] . '</td>' .'<td>' . $data1['Cantidad'] . '</td> </tr>';
    }

    $mail->Body    = '
    <h1> HELADOS ARTESANALES SLR </h1>
    <h2> Datos Generales Factura # '. $NoFactura .' | Fecha: '. $Fecha .' </h2>
    <h3> Identidad: '. $Identidad .' | Cliente: '. $Comprador .' </h3>
    <h3> Sucursal: '. $Sucursal .' </h3>
    <h3> RTN: '. $RTN .' </h3>
    <h3> Nota: '. $Nota .' </h3>
    
    <br><hr><br>
    
    <table style="width:100%" border="2">
        <thead>
            <tr>
                <th> Categoria </th>
                <th> Producto </th>
                <th> Cantidad </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                '. $dynTable .'
            </tr>
        </tbody>
    </table>
    ';

    $mail->send();
} catch (Exception $e) {
    
}
?>