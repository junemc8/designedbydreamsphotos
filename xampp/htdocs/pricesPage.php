 <?php
 /* Photo Price Page displays cost for various photo sessions and packages*/
require('fpdf.php');                               //PHP class to create dynamic pdf 
require('makefont/makefont.php');                  //Allow the addition of various fonts to use

/*
This class extends the FPDF class so that headers, footers, and fonts can be added incorporated. Data
for packages and sessions are established and can be dynamically written to the pdf page by creadting
objects and using various methods.

*/

class PDF extends FPDF
{
	public $title = "Designed By Dream Photos";
	public $pic_one = "\"Going Solo\"";
	public $pic_two = "\"Double Take\"";
	public $pic_three = "\"Three's Company\"";
	public $pic_four = "\"The More The Merrier\"";
	public $pic_one_data = array(" ", " 1 Person", " 15 Minute Session", " 10 Digital Images", " Photo Release", " ");
	public $pic_two_data = array(" ", " 1-2 Person(s)", " 20 Minute Session", " 15 Digital Images", " Photo Release", " ");
	public $pic_three_data = array(" ", " 1-3 Person(s)", " 30 Minute Session", " 20 Digital Images", " Photo Release", " Facebook Cover", " ");
	public $pic_four_data = array(" ", " 1-6 Person(s)", " 45 Minute Session", " 30 Digital Images", " Photo Release", " Facebook Cover", " ");
	public $data1 = '';
	public $data2 = '';
	public $data3 = '';
	public $data4 = '';
	public $portrait1 = array(" ", "Package 1", "(1) 8x10*(2) 5x7*(4) 4x5*(8) wallets = $55.00");
	public $port1 = '';
	public $portrait2 = array(" ", "Package 2", "(2) 8x10*(4) 5x7*(8) 4x5*(16) wallets = $110.00");
	public $port2 = '';
	public $portrait3 = array(" ", "Package 3", "(1) 11x14, (1) 8x10*(2) 5x7*(16) wallets = $150.00");
	public $port3 = '';
	public $all_portraits = '';
	public $mvp = array(" ", "MVP Package  $50.00", "(1) 8x10 Sports Mate", "(1) 8x10 Magazine", 
	                    "(2) 5x7 Individuals", "(16) 2x3 Personalized");
	public $mvp_portrait = '';
	public $star = array(" ", "Star Package $30.00", "(1) Individual", "(1) 5x7 Team", 
	                          "(2) 4x6 Individuals", "(8) 2x3 wallets");
	public $star_portrait = '';
	public $hot = array(" ", "Hot Package $25.00", "(1) 5x7 Team", "(1) 5x7 Individual", "(8) 2x3 wallets");
	public $hot_portrait = '';
	public $team = array(" ", "Hot Package $20.00", "(1) 5x7 Team", "(1) 5x7 Individual");
	public $team_portrait = '';
	public $extras = 'Extras - YOU MAY PURCHASE EXTRAS WITHOUT BUYING PACKAGES';
	public $extra_data= array('(1) 11x14 Canvas' => "$45.00",
                              '(1) 16x20 Canvas' => "$80.00",
                              '(1) 20x24 Canvas' => "$10.00",
                              '(8) 2x3 Wallets' => "$15.00",
                              '(1) 5x7 Individual' => "$10.00",
                              '(1) 8x10 Individual' => "$10.00",
                              '(1) 8x10 Magazine' => "$20.00",
                              '(1) 8x10 Sports mate' => "$20.00");
	public $extra = '';
	
// Page header
function Header()
{
    // Border and Logo
	$this->Image('images/formal-border.png',0,0,210.5,300);
    $this->Image('images/horizon3.jpg',15,20,30);

	//Set font and font color
	$this->AddFont('Calligrapher','','calligra.php');
	$this->SetFont('Calligrapher','',20);
   	$this->SetTextColor(66,134,244);
	
	// Move to the right -- start writing title at this position
    $this->Cell(50);
	//Get width of title to draw box around it
	$w = $this->GetStringWidth($this->title)+11;
    // Title
	$this->Image('images/gold_black.jpg',50,12,120,25);
    $this->Cell($w,30,$this->title,0,10,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();      //Keep track of number of pages
$pdf->AddPage();
$pdf->SetFont('Times','BI',12);

//Get width of "Solo" package to draw box around it
$pdf->SetDrawColor(0,0,180);
$pdf->SetFillColor(170,169,148);
$pdf->SetLineWidth(1);
$p1 = $pdf->GetStringWidth($pdf->pic_one)+13;
$pdf->Cell($p1,10,$pdf->pic_one,1,0,'C',1);

//Set Position for 2nd group package
$pdf->SetX(56);

//Get width of "Double Trouble" package to draw box around it
$pdf->SetDrawColor(0,0,180);
$pdf->SetFillColor(170,169,148);
$pdf->SetLineWidth(1);
$p2 = $pdf->GetStringWidth($pdf->pic_two)+10;
$pdf->Cell($p2,10,$pdf->pic_two,1,0,'C',1);

//Set Position for 3rd group package
$pdf->SetX(103);

//Get width of "Three's Company" package to draw box around it
$pdf->SetDrawColor(0,0,180);
$pdf->SetFillColor(170,169,148);
$pdf->SetLineWidth(1);
$p3 = $pdf->GetStringWidth($pdf->pic_three)+5;
$pdf->Cell($p3,10,$pdf->pic_three,1,0,'C',1);

//Set Position for 4th group package
$pdf->SetX(152);
//$pdf->SetFont('Times','BI',12);

//Get width of "The More The Merrier" package to draw box around it
$pdf->SetDrawColor(0,0,180);
$pdf->SetFillColor(170,169,148);
$pdf->SetLineWidth(1);
$p4 = $pdf->GetStringWidth($pdf->pic_four)+5;
$pdf->Cell($p4,10,$pdf->pic_four,1,1,'C',1);

//Write Data for solo, double trouble, three's company, and the more the merrier
$pdf->SetFont('Times','',12);
foreach($pdf->pic_one_data as $value) {
  $pdf->data1 .= $value . "\n";
}

$pdf->MultiCell($p1,5,$pdf->data1,1,'L');



foreach($pdf->pic_two_data as $value) {
  $pdf->data2 .= $value . "\n";
}
//Set Position for 2nd group package
$pdf->SetXY(56,-227);
$pdf->MultiCell($p2,5,$pdf->data2,1,'L');

foreach($pdf->pic_three_data as $value) {
  $pdf->data3 .= $value . "\n";
}
//Set Position for 3rd group package
$pdf->SetXY(103,-227);
$pdf->MultiCell($p3,5,$pdf->data3,1,'L');

foreach($pdf->pic_four_data as $value) {
  $pdf->data4 .= $value . "\n";
}
//Set Position for 4th group package
$pdf->SetXY(152,-227);
$pdf->MultiCell($p4,5,$pdf->data4,1,'L');

//Get data from package arrays and assemble into one variable
$pdf->SetXY(10,130);
foreach($pdf->portrait1 as $value) {
  $pdf->port1 .= $value . "\n";
}
$pdf->port1 .= "\n";

foreach($pdf->portrait2 as $value) {
  $pdf->port2 .= $value . "\n";
}
$pdf->port2 .= "\n";

foreach($pdf->portrait3 as $value) {
  $pdf->port3 .= $value . "\n";
}
$pdf->port3 .= "\n";

//Combine all packages for output to pdf page
$pdf->all_portraits = $pdf->port1 . $pdf->port2 . $pdf->port3;

//Print heading for Portrait Packages
$pdf->SetFont('Calligrapher','',14);
$pdf->SetTextColor(65,28,175);
$pdf->Cell(90,10,"Portrait Packages",0,0,'C');

//Set position and print heading for Sport Packages
$pdf->SetX(100);
$pdf->SetFont('Calligrapher','',14);
$pdf->SetTextColor(65,28,175);
$pdf->Cell(90,10,"Sport Packages",2,1,'C');

$pdf->SetFont('Calligrapher','',12);
$pdf->SetTextColor(78,89,88);
$pdf->MultiCell(90,5,$pdf->all_portraits,0,'L');

//Set position and print data for sport packages
$pdf->SetTextColor(65,28,175);
$pdf->setXY(100, -157);
foreach($pdf->mvp as $value) {
  $pdf->mvp_portrait .= $value . "\n";
}
$pdf->SetTextColor(78,89,88);
$pdf->MultiCell(90,5,$pdf->mvp_portrait,0,'L');

$pdf->setXY(150, -157);
foreach($pdf->star as $value) {
  $pdf->star_portrait .= $value . "\n";
}
$pdf->MultiCell(90,5,$pdf->star_portrait,0,'L');

$pdf->setXY(100, -127);
foreach($pdf->hot as $value) {
  $pdf->hot_portrait .= $value . "\n";
}
$pdf->MultiCell(90,5,$pdf->hot_portrait,0,'L');

$pdf->setXY(150, -127);
foreach($pdf->team as $value) {
  $pdf->team_portrait .= $value . "\n";
}
$pdf->MultiCell(90,5,$pdf->team_portrait,0,'L');

//Print data for packages extras
$pdf->SetFont('Calligrapher','',15);
$pdf->SetTextColor(65,28,175);

$pdf->SetXY(10,205);
$ex = $pdf->GetStringWidth($pdf->extras)+5;
$pdf->Cell($ex,10,$pdf->extras,1,1,'C');

$pdf->SetFont('Calligrapher','',14);
$pdf->SetTextColor(78,89,88);
$pdf->SetXY(50,220);
$pdf->Cell(90,10,"(1) 11x14 Canvas", 0,0, 'L');

$pdf->SetXY(120,220);
$pdf->Cell(90,10,"$45.00", 0,1, 'L');

$pdf->SetXY(50,226);
$pdf->Cell(90,10,"(1) 16x20 Canvas", 0,0, 'L');

$pdf->SetXY(120,226);
$pdf->Cell(90,10,"$80.00", 0,1, 'L');

$pdf->SetXY(50,232);
$pdf->Cell(90,10,"(1) 20x24 Canvas", 0,0, 'L');

$pdf->SetXY(120,232);
$pdf->Cell(90,10,"$10.00", 0,1, 'L');

$pdf->SetXY(50,238);
$pdf->Cell(90,10,"(8) 2x3 Wallets", 0,0, 'L');

$pdf->SetXY(120,238);
$pdf->Cell(90,10,"$15.00", 0,1, 'L');

$pdf->SetXY(50,244);
$pdf->Cell(90,10,"(1) 5x7 Individual", 0,0, 'L');

$pdf->SetXY(120,244);
$pdf->Cell(90,10,"$10.00", 0,1, 'L');

$pdf->SetXY(50,250);
$pdf->Cell(90,10,"(1) 8x10 Individual", 0,0, 'L');

$pdf->SetXY(120,250);
$pdf->Cell(90,10,"$10.00", 0,1, 'L');

$pdf->SetXY(50,256);
$pdf->Cell(90,10,"(1) 8x10 Magazine", 0,0, 'L');

$pdf->SetXY(120,256);
$pdf->Cell(90,10,"$20.00", 0,1, 'L');

$pdf->SetXY(50,262);
$pdf->Cell(90,10,"(1) Sports Mate", 0,0, 'L');

$pdf->SetXY(120,262);
$pdf->Cell(90,10,"$20.00", 0,1, 'L');

//Output dynamic page
$pdf->Output();
?>