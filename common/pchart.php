<?
class Pchart {
    function chart($param) {
        $pchart_root = "../pChart2.1.3/";
        $graph_root = "../img/graph/";
        include($pchart_root."class/pData.class.php");
        include($pchart_root."class/pDraw.class.php");
        include($pchart_root."class/pImage.class.php");

        $usedata = ($param['chartdata'])? : array(3,9,10,12,15,20,30);
        $xdata = array(48,40,32,24,16,8,0);

        $pdata = new pData();
        $pdata->setAxisName(0, "Sell Count"); // y label
        $pdata->addPoints($xdata, "Labels");
        $pdata->setSerieDescription("Labels", "Befor Hour");
        $pdata->setAbscissa("Labels"); // x label

        $pdata->addPoints($usedata, "line1");
        $pdata->setPalette("line1", array("R"=>229, "G"=>11, "B"=>11, "Alpha"=>80));

        $x = 170;
        $y = 120;
        $xstart = 25;
        $xend = $x;
        $ystart = 5;
        $yend = $y - 15;

        $chart = new pImage($x, $y, $pdata);
        $chart->setFontProperties(array("FontName"=>$pchart_root."fonts/verdana.ttf", "FontSize"=>6));
        $chart->setGraphArea($xstart, $ystart, $xend, $yend);
        $chart->drawScale();
        $chart->drawSplineChart();
        $graph_name = $graph_root.$param['deal_no'];
        $chart->Render($graph_name);
        //$chart->autoOutput();
        return $graph_name;
    }
}
?>
