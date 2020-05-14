<template>
	<div>
		Create qr-code
		<div>
			<input type="text" v-model="data" maxlength="500">
			<button @click="create">Create</button>
			<div class="qr-code" v-if="output" v-html="output">
				
			<!-- 	<img v-if="data" :src="'http://localhost:3000/api/test?data=' + encodeURI(data)" alt = "" title = "" /> -->
			</div>
			<ul class="menu menu_reversed blink-text-menu">
				<li><a href="#">Home</a></li>
				<li><a href="#">Archives</a></li>
				<li><a href="#">Tags</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">About</a></li>
			</ul>
		</div>
	</div>
</template>
<style lang="scss">
	.qr-code{
		margin-top: 30px;
	}
</style>
<script>
	export default {
		data(){
			return {
				data: '',
				output: ''
			}
		},
		methods:{
			create(){
				this.$http({
				    url: 'test?data=' +  encodeURI(this.data),
				    method: 'GET',
				    
				})
				    .then((res) => {
					  this.output = res.data
				});
			
			}
		}
	}
</script>