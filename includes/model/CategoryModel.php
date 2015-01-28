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
    
    
    
    function addCategory($parent,$category,$position)
    {
		try{
			$stmt = $this->connexion->prepare("INSERT INTO survival_guide_categories(name,content,code_section) VALUES (:name,:content,:code_section)");
			$stmt->bindParam(':name',$category->name);
			$stmt->bindParam(':content',$category->content);
			$stmt->bindParam(':code_section',$category->section);
			$stmt->execute();
			
			$id = $this->connexion->lastInsertId();
			echo 'id:' . $id; 
			
			if($parent == 0)
			{
				$partie=0;
				$chapitre=0;
			}
			else 
			{
				
				$stmt = $this->connexion->prepare("SELECT * from survival_guide_relation WHERE idCategorie=:id");
				$stmt->bindParam(':id',$parent);
				$stmt->execute();
				
				$data=$stmt->fetch(PDO::FETCH_OBJ);
				if($data){
				
					if($data->chapitre == 0){
					
						if($data->partie == 0)
						{
							$partie=$data->idCategorie;
							$chapitre=0;
						}
						else
						{
							$partie=$data->partie;
							$chapitre=$data->idCategorie;
						}
					}
					else
					{
						throw new Exception('The category you want to add are too deep');
					}
					$this->updateContentCategories($data->idCategorie,'',$category->section);
				}
				else
				{
					throw new Exception('The parent category doesn\' exist');
				}
				
			}
			
			

			$stmt = $this->connexion->prepare("INSERT INTO survival_guide_relation(idCategorie,partie,chapitre,position) VALUES (:id,:partie,:chapitre,:position)");
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':partie',$partie);
			$stmt->bindParam(':chapitre',$chapitre);
			$stmt->bindParam(':position',$position);
			$stmt->execute();
			
			
		}
        catch (Exception $e)
        {
            if($id!=0)
            {
				$this->deleteCategory($id);
			}
            die('Erreur : ' . $e->getMessage());
        }
	}
	
	function deleteCategory($id,$code_section)
	{
		try{


			// vérification des droits de suppression
			$stmt = $this->connexion->prepare("SELECT idCategorie from survival_guide_categories WHERE idCategorie=:id and code_section=:code_section");
            		$stmt->bindParam(':id',$id);
            		$stmt->bindParam(':code_section',$code_section);
            		$stmt->execute();
			if(!($data=$stmt->fetch(PDO::FETCH_OBJ)))
            		{
				return;
			}			


			
			$stmt = $this->connexion->prepare("SELECT idCategorie from survival_guide_relation WHERE relation.partie=:id OR relation.chapitre=:id");
            		$stmt->bindParam(':id',$id);
            		$stmt->execute();

            
		        while($data=$stmt->fetch(PDO::FETCH_OBJ))
            		{
				$stmt = $this->connexion->prepare("DELETE FROM survival_guide_relation WHERE idCategorie=:idCategorie");
				$stmt->bindParam(':idCategorie',$data->idCategorie);
				$stmt->execute();
			
				$stmt = $this->connexion->prepare("DELETE FROM survival_guide_categories WHERE idCategorie=:idCategorie");
				$stmt->bindParam(':idCategorie',$data->idCategorie);
				$stmt->execute();
					
			}


			$stmt = $this->connexion->prepare("DELETE FROM survival_guide_relation WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
			
			$stmt = $this->connexion->prepare("DELETE FROM survival_guide_categories WHERE idCategorie=:idCategorie");
			$stmt->bindParam(':idCategorie',$id);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
	}
    
    function updatePositionCategories($id,$position,$code_section)
    {
	try{

		echo "test1";
		// vérification des droits de suppression
			$stmt = $this->connexion->prepare("SELECT idCategorie from survival_guide_categories WHERE idCategorie=:id and code_section=:code_section");
            		$stmt->bindParam(':id',$id);
            		$stmt->bindParam(':code_section',$code_section);
            		$stmt->execute();
			if(!($data=$stmt->fetch(PDO::FETCH_OBJ)))
            		{
				return;
			}	

		echo "test2";
		$stmt = $this->connexion->prepare("UPDATE survival_guide_relation SET position=:position WHERE idCategorie=:idCategorie");
		$stmt->bindParam(':position',$position);
		$stmt->bindParam(':idCategorie',$id);
		$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function updateNameCategories($id,$name,$code_section)
    {
		try{
			$stmt = $this->connexion->prepare("UPDATE survival_guide_categories SET name=:name WHERE idCategorie=:idCategorie and code_section=:code_section");
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':idCategorie',$id);
			$stmt->bindParam(':code_section',$code_section);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
	function updateContentCategories($id,$content,$code_section)
    {
		try{
			$stmt = $this->connexion->prepare("UPDATE survival_guide_categories SET content=:content WHERE idCategorie=:idCategorie and code_section=:code_section");
			$stmt->bindParam(':content',$content);
			$stmt->bindParam(':idCategorie',$id);			
			$stmt->bindParam(':code_section',$code_section);
			$stmt->execute();
		}
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
	}

    function getCategories($section)
    {
	try{


            $stmt = $this->connexion->prepare("SELECT * from survival_guide_relation, survival_guide_categories WHERE code_section=:section and survival_guide_relation.idCategorie=survival_guide_categories.idCategorie order by partie ASC, chapitre ASC, position ASC");
            $stmt->bindParam(':section',$section);
            $stmt->execute();

            $categories=array();
            
            while($data=$stmt->fetch(PDO::FETCH_OBJ))
            {
                $c = new Category($data->idCategorie,$data->name,$data->code_section,$data->content,$data->position);
                
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


