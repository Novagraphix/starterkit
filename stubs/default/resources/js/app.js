import Swal from 'sweetalert2'

window.addEventListener("swal:confirm", data => {
    SwalConfirm(
        data.detail[0].icon,
        data.detail[0].title,
        data.detail[0].text,
        data.detail[0].confirmText,
        data.detail[0].method,
        data.detail[0].params,
        data.detail[0].callback
    );
});

let SwalConfirm = (
    icon,
    title,
    html,
    confirmButtonText,
    method,
    params,
    callback
) => {
    Swal.fire({
        title,
        html,
        showCancelButton: true,
        confirmButtonText,
        cancelButtonText: "Abbrechen",
        reverseButtons: true,
        icon: icon,
        backdrop: `
                rgba(0,0,123,0.4)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `,
    }).then((result) => {
        if (result.value) {
            return window.dispatchEvent(new CustomEvent(method, { detail: { model: params } }));
        }

        if (callback) {
            return window.dispatchEvent(new Event(callback));
        }
    });
};
