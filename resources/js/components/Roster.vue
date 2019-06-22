
<template>

    <div v-if="playerDatas != null">
        <div v-for="i in 12" :key="i">
            <div v-if="getCharByClass(orderList[i].id) != false">
                <table style="border: 1px solid  rgba(32, 32, 32, 0.719)" class="table table-dark">
                    <tr class="roster-tr-title">
                        <td v-bind:style="{ color: orderList[i].classColor }" style="background-color: rgba(222, 222, 222, 0);" colspan="4">
                            <span style="float:right; font-size: 17px;">
                                {{ orderList[i].className }}s - PH
                            </span>
                        </td>
                    </tr>
                    <tr v-for="char in getCharByClass(orderList[i].id)" :key="char[1].character.name">
                        <td class="roster-td-30" v-bind:style="{ color: orderList[i].classColor }">{{ char[1].character.name }}</td>
                        <td class="roster-td-20" v-if="char[1].character.spec != undefined">
                            {{ char[1].character.race }} {{ char[1].character.spec.role }}
                        </td>
                        <td class="roster-td-20" v-else>
                            N/A
                        </td>
                        <td class="roster-td-20">{{ char[1].rank }}</td>
                        <td class="roster-td-20">ArmoryLinky</td>
                    </tr>
                </table>
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
                    { id: "id", className: "Class Name"},
                    { id: 6, className: "Death Knight", classColor: "#A330C9" },
                    { id: 12, className: "Demon Hunter", classColor: "#A330C9" },
                    { id: 11, className: "Druid", classColor: "#FF7D0A" },
                    { id: 3, className: "Hunter", classColor: "#ABD473" },
                    { id: 8, className: "Mage", classColor: "#69CCF0" },
                    { id: 10, className: "Monk", classColor: "#00FFBA" },
                    { id: 2, className: "Paladin", classColor: "#F58CBA" },
                    { id: 5, className: "Priest", classColor: "#FFFFFF" },
                    { id: 4, className: "Rogue", classColor: "#FFF569" },
                    { id: 7, className: "Shaman", classColor: "#0070DE" },
                    { id: 9, className: "Warlock", classColor: "#9482C9" },
                    { id: 1, className: "Warrior", classColor: "#C79C6E" }
                ],
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
                        return c;
                    } else {
                        return false;
                    }
                });
            }
        },
        created: function () {
            this.getPlayerData();
            // console.log(Object.entries(this.orderList));
            console.log(this.orderList[1].id);
        }

    }
</script>
