      function createGUI() {
         // absolute file path can be used as well
         var filename = "../data/controlPlots_ttbar.root";
         new JSROOT.TFile(filename, function(file) {
            file.ReadObject("stage_5/top/bestHmass", function(obj) {
               JSROOT.draw("drawing", obj, "");
            });
         });
      }
