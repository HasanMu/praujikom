var $no = 0;
setInterval(() => {
    var ifConnected = window.navigator.onLine;
    if (ifConnected) {
        // $no = 0;
        if ($no > 0) {
            // console.log('Connection available');
            iziToast.success({
                transitionIn: "flipInX",
                transitionOut: "bounceInDown",
                transitionInMobile: "flipInX",
                transitionOutMobile: "bounceInDown",
                title: "Bagus!",
                message: "Kamu terhubung kembali!",
                position: "bottomLeft"
            });
            $no = 0;
        } else {
            $no = 0;
        }
    } else {
        // console.log('Connection not available');
        // console.log($no);

        if ($no === 0) {
            iziToast.error({
                timeout: 4000,
                transitionIn: "fadeInRight",
                transitionOut: "fadeInDown",
                transitionInMobile: "fadeInRight",
                transitionOutMobile: "bounceInDown",
                title: "Ups! ",
                message: "Koneksi internetmu hilang!",
                position: "bottomLeft"
            });
            setTimeout(() => {
                iziToast.warning({
                    timeout: 4500,
                    title: "Tunggu,",
                    message: "Menyambungkan kembali!",
                    position: "bottomLeft"
                });
            }, 3500);
            $no += 1;
            // console.log($no+" ==");
        } else {
            $no += 1;
            if ($no >= 10) {
                $no = 0;
            }
        }
        // console.log($no);
    }
}, 3000);
