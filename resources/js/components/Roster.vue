
<template>

    <div v-if="playerDatas != null">

        <div v-for="(classInfo) in Object.entries(orderList)" :key="classInfo[1].id">
            {{ classInfo[1].className }}
            <div v-for="char in getCharByClass(classInfo[1].id)" :key="char[1].character.name">
                <li>
                    {{ char[1].character.name}}
                </li>
            </div>
        </div>

    </div>
    <div class="d-flex align-center" v-else>
        Loading ....
    </div>

</template>

<script>

    import axios from 'axios';

    export default {

        data: () => {
            return {
                playerDatas: null,
                charList: null,
                orderList:[
                    { id: 6, className: "Death Knight" },
                    { id: 12, className: "Demon Hunter" },
                    { id: 11, className: "Druid" },
                    { id: 3, className: "Hunter" },
                    { id: 8, className: "Mage" },
                    { id: 10, className: "Monk" },
                    { id: 2, className: "Paladin" },
                    { id: 5, className: "Priest" },
                    { id: 4, className: "Rogue" },
                    { id: 7, className: "Shaman" },
                    { id: 9, className: "Warlock" },
                    { id: 1, className: "Warrior" }
                ]
            }
        },
        methods: {
            getPlayerData: function() {
                axios.get('http://127.0.0.1:8000/api/get-roster')
                    .then((response) => {
                        const allowedRanks = [0, 1, 3, 4, 5];
                        this.playerDatas = response.data.members;
                        this.charList = Object.entries(this.playerDatas);
                    })
                    .catch((response) => {
                        console.log(response);
                    })
            },
            getCharByClass: function(classId) {
                return this.charList.filter((c) => {
                    if (c[1].character.class == classId) {
                        return c[1].character.name;
                    }
                });
            }
        },
        computed: {

        },
        created: function () {
            this.getPlayerData();
            console.log(Object.entries(this.orderList));
        }

    }
</script>
