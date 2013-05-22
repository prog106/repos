<?
function javascript() {
?>
<script type="text/javascript">
$(function () {
    var austDay = new Date();
    austDay = new Date(<?=date('Y');?>, <?=date('m');?> - 1, <?=date('d');?>, 23, 59, 59);
    $('#countdown').countdown({
        until: austDay,
        format:'HMS',
        compact:true,
        layout: '{hnn}{sep}{mnn}{sep}{snn} Left Today' + "(<?=date('Y-m-d');?>)"
    });
});
</script>
<?
}
?>

