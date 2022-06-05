
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORNER - MENU</title>
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
    $query = "SELECT CASE WHEN CORNER_ORDER.CORNERNAME IS NULL THEN '총 합계' ELSE CORNER_ORDER.CORNERNAME END AS 코너이름, MENU.MENU_NAME 메뉴이름, COUNT(CORNER_ORDER.MENU_ID) 주문건수
    FROM CORNER_ORDER,MENU
    WHERE MENU.MENU_ID = CORNER_ORDER.MENU_ID
    GROUP BY CORNER_ORDER.CORNERNAME, MENU.MENU_NAME WITH ROLLUP";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>코너별 메뉴별 주문 건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>코너 이름</TD>
            <TD>메뉴 이름</TD>
            <td>주문 건수</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['메뉴이름']?></TD>
                <TD><?=$row['주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<!-- <p>*순수익 기준 오름차순 정렬</p> -->
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

