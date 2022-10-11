<template>
	<div>
		<canvas 
			:id="canvasId" 
			:width="canvaswidth" 
			:height="canvasheight">
		</canvas>
	</div>
</template>

<script>
	export default {
		name: 'SpiralComponent',
		data: () => ({

		}),
		props: {
			text: String,
			spread: Number,
			gap: Number,
			charRotation: Number,
			id: String,
			textFontSize: String,
			canvasHeight: Number,
			canvasWidth: Number,
		},
		mounted() {
			this.drawSpiral(this.text)
		},
		methods: {
			drawSpiral(text) {
				var c = document.getElementById(this.id);
				var context = c.getContext("2d");
				var centerX = context.canvas.width / 2;
				var centerY = context.canvas.width / 2;

				context.clearRect(0, 0, centerX, centerY);

	      context.font = this.textFontSize + 'px sans';

	      var char = 0;

				context.moveTo(centerX, centerY);
				
		    while(char < text.length) {
		    	let angle = char * 0.1;
					let newX = centerX + (this.spread + this.gap * angle) * Math.sin(angle);
					let newY = centerY + (this.spread + this.gap * angle) * Math.cos(angle);
					/* rotate the character */
					let rot = Math.atan2(newY - centerY, newX - centerX);
					context.save();
					context.translate(newX, newY);
					context.rotate(rot + (this.charRotation*2*Math.PI));
					context.fillText(text[char], 0, 0);
					context.restore();
					char++;
	      }
	      /* draw the spiral */
	      context.stroke();
			}
		},
		computed: {
			canvasId() {
				return this.id
			},
			canvaswidth() {
				return this.canvasWidth
			},
			canvasheight() {
				return this.canvasHeight
			}
		}
	}
</script>