const axios = require('axios');

axios.get('http://vserverapp/merulink/rooms/rooms/roomStatusScheduledTask')
    .then(response=>{
        console.log(response.data)
    })
    .catch(error=>{
        console.log(error)
    });