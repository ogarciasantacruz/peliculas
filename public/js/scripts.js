// Message notification
function notification(title, subtitle, timer = 1000) 
{
    let timerInterval
    Swal.fire({
        title: title,
        html: subtitle,
        timer: timer,
        onBeforeOpen: () => {
            Swal.showLoading()
                timerInterval = setInterval(() => {
                
            }, 100);
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    });
}
