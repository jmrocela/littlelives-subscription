$(function() {
    
    
    /*
     * Create an animated loading graphic.
     * 
     * TODO: Declare a canvas selector with a "spinner" id.
     * @param {} none.
     * @return {} none 
     */
    var canvas = document.getElementById('spinner');
    var context = canvas.getContext('2d');
    var start = new Date();
    var lines = 14,  
    cW = context.canvas.width,
    cH = context.canvas.height;

    var draw = function() {
        var rotation = parseInt(((new Date() - start) / 1000) * lines) / lines;
        context.save();
        context.clearRect(0, 0, cW, cH);
        context.translate(cW / 2, cH / 2);
        context.rotate(Math.PI * 2 * rotation);
        for (var i = 0; i < lines; i++) {
            context.beginPath();
            context.rotate(Math.PI * 2 / lines);
            context.moveTo(cW / 10, 0);
            context.lineTo(cW / 4, 0);
            context.lineWidth = cW / 30;
            context.strokeStyle = "rgba(0, 0, 0," + i / lines + ")";
            context.stroke();
        }
        context.restore();
    };
    window.setInterval(draw, 1000 / 30);
});