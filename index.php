<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <form action="index.php" method="post" id="form">
        <div style="    display: flex;
    flex-direction: column;
    align-items: flex-start;">
            <select onchange="Change()" id="type" name="type">
                <option>Square</option>
                <option>Circle</option>
                <option>Rectangle</option>
            </select>
            <input type="text" name="X" value="X" id="X">
            <input type="submit">
        </div>
    </form>

    <script src="./script.js"></script>
</body>

</html>

      



<?php
const FILENAME = "array.txt";
const PI = 3.14;
interface IFigure
{
    public function S();
    public function P();
    public function SetX(int $a);
}


class Square implements IFigure
{
    private int $a;
    public function __construct(int $a)
    {
        $this->SetX($a);
    }
    public function SetX(int $a)
    {
        $this->a = $a;
    }

    public function S(): int
    {
        return $this->a * $this->a;
    }
    public function P(): int
    {
        return $this->a + $this->a;
    }
}

class Circle implements IFigure
{
    private $r;
    public function __construct(int $r)
    {
        $this->SetX($r);
    }
    public function S(): float
    {
        return PI * $this->r;
    }
    public function SetX(int $r)
    {
        $this->r = $r;
    }
    public function P(): float
    {
        return 2 * (PI * $this->r);
    }
}

class Rectangle implements IFigure
{
    private $a;
    private $b;
    public function __construct(int $x, int $y)
    {
        $this->SetX($x);
        $this->SetY($y);
    }
    public function SetX(int $r)
    {
        $this->a = $r;
    }
    public function SetY(int $y)
    {
        $this->b = $y;
    }
    public function S(): int
    {
        return $this->a * $this->b;
    }
    public function P(): int
    {
        return 2 * ($this->a + $this->b);
    }
}

$type;
$X;
$Y;

function Set($typeRequest, $XRequest)
{
    global $type;
    $type = $typeRequest;
    global $X;
    $X = $XRequest;
}

$arrayFileContent;
function CreateTable()
{
    
    $fileContent = file_get_contents(FILENAME).PHP_EOL;
    
    global $arrayFileContent;
    $arrayFileContent = explode(";", $fileContent);
    
    echo '<div>'.
    "<div style='display:flex;justify-content: space-around;'><span>ID</span><span>type</span><span>S</span><span>P</span></div>";

    $arrayFileContent = explode(';',implode(";", $arrayFileContent));
    
    
    for ($i=0; $i < count($arrayFileContent)-1; $i++) { 
        $arrayExploded = explode(":", $arrayFileContent[$i]);

        $type = $arrayExploded[0];
        $X = $arrayExploded[1];
        $Y = $arrayExploded[2];
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='$i'>";
        echo "<div style='display:flex;justify-content: space-around;'><span>$i</span><span>$type</span><span>$X</span><span>$Y</span><input type='submit' value='Удалить'></div>";
        echo "</form>";
    }

    
}

function DeleteElement($arrayFileContent, $i)
{

    unset($arrayFileContent["$i"]);
    $arrayImploded = implode(';', $arrayFileContent);
    print_r($arrayFileContent);
    print_r($arrayImploded);
    file_put_contents(FILENAME, $arrayImploded);
}
function GetKeysFromArray($array)
{
    $arrayKeys = explode(";", $array);
    echo $arrayKeys[0];
    echo $arrayKeys[1];
    echo $arrayKeys[2];
}

if (isset($_POST['type']) && isset($_POST['X'])) {
    if ($_POST['type'] == 'Rectangle' && isset($_POST['Y'])) {
        $Y = $_POST['Y'];
    }
    Set($_POST['type'], $_POST['X']);
}



if (isset($_POST['type'])) {

    echo $type . PHP_EOL;
    $S;
    $P;
    switch ($type) {

        case 'Square':
            $square = new Square($X);
            $S = $square->S();
            $P = $square->P();
            break;
        case 'Circle':
            $circle = new Circle($X);;
            $S = $circle->S();
            $S = round($S, 2);
            $P = $circle->P();
            break;
        case 'Rectangle':
            $rectangle = new Rectangle($X, $Y);
            $S = $rectangle->S();
            $P = $rectangle->P();
            break;

        default:

            break;
    }
    echo "S: "."$S" . PHP_EOL;
    echo "P: "."$P".PHP_EOL;
    file_put_contents(FILENAME, $type.":".$S.":".$P.";", FILE_APPEND);
}





CreateTable();
if (isset($_POST['id'])) {
    DeleteElement($arrayFileContent, $_POST['id']);
}

//
    