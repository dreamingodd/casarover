$(function(){
    
});

// digits < 15
function getRandom(digits) {
    return Math.round(Math.random() * Math.pow(10, digits));
}
/**
 * Get a random number from 0 - 7.
 * @returns 1-8
 */
function getRandom8() {
    var r = getRandom(4);
    return r % 8;
}