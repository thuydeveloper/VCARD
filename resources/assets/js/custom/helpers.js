window.listen = function (event, selector, callback) {
    $(document).on(event, selector, callback)
}
window.listenClick = function (selector, callback) {
    $(document).on('click', selector, callback)
}
window.listenSubmit = function (selector, callback) {
    $(document).on('submit', selector, callback)
}
window.listenHiddenBsModal = function (selector, callback) {
    $(document).on('hidden.bs.modal', selector, callback)
}
window.listenChange = function (selector, callback) {
    $(document).on('change', selector, callback)
}
window.listenKeyup= function (selector, callback) {
    $(document).on('keyup', selector, callback)
}

window.getFormattedDateTime = function (userDateFormate, isMomentFormat = null) {
    if(userDateFormate == 1){
        return isMomentFormat ?  ('DD MMM, Y') : ('d M, Y') ;
    }
    if(userDateFormate == 2){
        return isMomentFormat ?  ('MMM DD, Y') : ('M d, Y') ;
    }
    if(userDateFormate == 3){
        return isMomentFormat ?  ('DD/MM/YYYY') : ('d/m/Y') ;
    }
    if(userDateFormate == 4){
        return isMomentFormat ?  ('YYYY/MM/DD') : ('Y/m/d') ;
    }
    if(userDateFormate == 5){
        return isMomentFormat ?  ('MM/DD/YYYY') : ('m/d/Y') ;
    }
    if(userDateFormate == 6){
        return isMomentFormat ?  ('YYYY-MM-DD') : ('Y-m-d') ;
    }
}

