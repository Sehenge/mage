/**
 * Created with JetBrains PhpStorm.
 * User: sehenge
 * Date: 4/30/13
 * Time: 5:37 PM
 * To change this template use File | Settings | File Templates.
 */

/*************************     BRANDBOX SLIDER   *******************************/


var cP = 1;
if($('#brandbox').length){
    var tP = $('#sliderContent').find("img").length;
    $('#sliderContent img').mouseover(function() {
        $(this).css('opacity', '1');
    })
    $('#sliderContent img').mouseout(function() {
        $(this).css('opacity', '0.5');
    })
}


function gotoPanel(id){
        console.log(id + ' ' + cP + ' ' + tP);
        $('#sliderContent').animate({left: -(800 * (id-1))}, 400);
}


function bL(){
    if(cP != 1){
        if (cP == 2) {
            document.getElementById("bLeft").className += " d";
        } else {
            document.getElementById("bLeft").className = "bNav";
        }
        document.getElementById("bRight").className = "bNav";
        cP -= 1;
        gotoPanel(cP);
    }
}
function bR(){
    if(cP != tP){
        if (cP == tP - 1) {
            document.getElementById("bRight").className += " d";
        } else {
            document.getElementById("bRight").className = "bNav";
        }
        document.getElementById("bLeft").className = "bNav";
        cP += 1;
        gotoPanel(cP);
    }
}