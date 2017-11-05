//copy.js 1.0.0
const oFs = require("fs")
const oPath = require('path')
const fnCopy = require('cpy')

const sPathStatic = oPath.join(__dirname,"../build")
const sPathDestiny = oPath.join(__dirname,"../../the_public")

if(oFs.existsSync(sPathStatic) && oFs.existsSync(sPathDestiny)){
    const fnHandler = (oErr)=>{
        if(oErr)console.log(oErr)
        else console.log("success!")
    }
    
    const sPathS = oPath.join(sPathStatic,"/*")
    const sPathD = oPath.join(sPathDestiny,"/")
    oFs.copy(sPathS,sPathD,fnHandler)
}
//fnCopy(['src/*.png', '!src/goat.png'], 'dist').then(() => {
//    console.log('files copied');
//});