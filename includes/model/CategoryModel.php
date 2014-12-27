<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

class CategoryModel{

    private $database;
    private $connexion;
    
    public function CategoryModel($database)
    {
        $this->database=$database;
        $this->connexion=$database->connexion;
    }

    function getCategories($section)
    {
	try{
            $stmt = $this->connexion->prepare("SELECT * from relation, categories WHERE code_section=:section and relation.idCategorie=categories.idCategorie order by partie ASC, chapitre ASC");
            $stmt->bindParam(':section',$section);
            $stmt->execute();

            $categories=array();
            
            while($data=$stmt->fetch(PDO::FETCH_OBJ))
            {
                $c = new Category($data->idCategorie,$data->name,$data->code_section,$data->content);
                
                if ($data->partie == 0 && $data->chapitre == 0)
                {
                    array_push($categories,$c);
                }
                else {
                       foreach($categories as $value)
                       {
                           if($value->id == $data->partie)
                           {
                               if($data->chapitre == 0)
                               {
                                $value->addCategoryToList($c);
                               }
                               else
                               {
                                $value->addSubcategoryToList($data);
                               }
                           }
                           
                        }
                    }
                        
                
            }
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        $test['categories'] = $categories;
	return $test;
    }	
    
    
}


