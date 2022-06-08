
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORNER - NET GAIN</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
    $conn = mysqli_connect("localhost","web","web_admin","ewha_food");
    if(!$conn){
        echo "Database Connection Error!";
    }
    if(mysqli_connect_errno()){
        echo "Could not connect: " . mysqli_connect_error();
        exit();
    }
    $query = "SELECT CORNER.CORNER_ID AS 코너 , CORNER.CORNER_NAME AS 코너이름, SUM(MENU.CUSTOMER_PRICE) AS 매출
    FROM CORNER, MENU
    WHERE CORNER.CORNER_ID = MENU.C_ID
    GROUP BY CORNER.CORNER_ID, CORNER.CORNER_NAME, CORNER.CORNER_ID
    ORDER BY SUM(MENU.CUSTOMER_PRICE);";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>코너별 매출</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>코너</TD>
            <TD>코너 이름</TD>
            <td>매출</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['코너']?></TD>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['매출']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*매출 기준 오름차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

