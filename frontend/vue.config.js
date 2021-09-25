 module.exports = {
   outputDir : '../public',
   configureWebpack: {
     externals: {
        zuricontrol : '@zuri/zuri-control'
     }
   }
 };