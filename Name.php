<?php
namespace Namelist;  
class Name 
{
    # Properties
    private $names;
    # Methods
    public function __construct($json)
    {
        # Load name data
        $namesJson = file_get_contents($json);
        $this->names = json_decode($namesJson, true);
    }
    public function getAll()
    {
        return $this->names;
    }
    public function getName(int $bday, int $personality, string $sex)
    {
        $results = [];
        $bdayarray =[];
        $personalityarray=[];
        $sexarray=[];
        
        //echo $this->names['Karen']['year'];
        # Filter name data according to input
        foreach ($this->names as $n => $name) {
            //echo $n;

            //bday input, 1990 is the divide line for names
            if ($bday > 1990 ){
                if ($name['year']>1990){
                    array_push($bdayarray,$n);
                }
         
            }else{
                if($name['year']<1990){
                    array_push($bdayarray,$n);
                }
            }
            //sex input
            if($sex == 'male'){
                if ($name['sex']=='male'){
                    array_push($sexarray,$n);
                }
            }else{
                if($name['sex']=='female'){
                    array_push($sexarray,$n);
                }
            }

            //personality input, I did a simply personality algorithm, giving number to each personality, and call corresponding number in the json file. 

            if($personality%3 == 0){
                if($name['personality']==1){
                    array_push($personalityarray,$n);
                }
            }else if($personality%3 == 1){
                if($name['personality']==2){
                    array_push($personalityarray,$n);
                }
            }else if($personality%3 == 2){
                if($name['personality']==3){
                    array_push($personalityarray,$n);
                }
            }
        }
            //find the name meet all the requirements.
        $results = array_intersect($sexarray, $personalityarray);
        $results = array_intersect($results, $bdayarray);
       // echo var_dump($results);

        if(!empty($results)){
            return $results;
        }
        

    }
}
