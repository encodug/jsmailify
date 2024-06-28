const Mailify = {
    send : function(sendData) {
        return new Promise((resolve, reject) => {
            fetch('http://localhost/sendmail.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                },
                body: JSON.stringify(sendData),
            }).then(response => response.json())
              .then(data => {
                    if(data.success) {
                        resolve({
                            success: true,
                            data: data
                        });
                    } else {
                        reject({
                            success: false,
                            data: data
                        });
                    }
              })
              .catch(error => {
                reject({
                    success: false,
                    error: error
                });
              });
        });
    },
    sendWithAttachment : function() {
        console.log('sendWithAttachment');
    } 
}