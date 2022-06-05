
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORNER - 코너별 총주문건수</title>
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
    $query = "SELECT CORNER_ORDER.CORNERNAME 코너이름, COUNT(CORNER_ORDER.CORNERNAME) 총주문건수
    FROM CORNER_ORDER
    GROUP BY CORNERNAME WITH ROLLUP;";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>코너별 총 주문건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>코너이름</TD>
            <TD>총주문건수</TD>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['총주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*코너이름 기준 오름차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

