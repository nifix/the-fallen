<template>

    <div class="mt-4">
        <div class="rio-wrapper">
            <div class="rio-header">Raider.IO - Progress<hr></div>
            <div class="rio-data mt-3">
                <div>
                    <p>Battle of Dazar'alor</p>
                    <p>{{ rioData["battle-of-dazaralor"].summary }}</p>
                </div>
                <div>
                    <p>Crucible of Storms</p>
                    <p>{{ rioData["crucible-of-storms"].summary }}</p>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';

    export default {
        data: () => {
            return {
                rioData:"N/A"
            }
        },
        methods: {
            grabData: function() {
                axios.defaults.headers.common = {};
                axios.get('https://raider.io/api/v1/guilds/profile?region=eu&realm=Ysondre&name=The%20Fallen&fields=raid_progression%2C%20raid_rankings')
                    .then((response) => {
                        this.rioData = response.data.raid_progression;
                    })
                    .catch((response) => {
                        console.log(response);
                    })
            }
        },
        created: function() {
            this.grabData();
        }
    }
</script>
