<?php 

declare(strict_types = 1);

class Room {
    private string $name;
    private string $description;
    private int $duration;
    private bool $forbidden18yearOld;
    private array $open;
    private int $minPlayers;
    private int $maxPlayers;
    private string $niveau;
    private string $readme;
    
    public function __construct(
        string $p_name, 
        string $p_description,
        int $p_duration = 60,
        bool $p_18yo = false,
        array $p_open = [],
        int $p_minPlayers = 2,
        int $p_maxPlayers = 12,
        string $p_niveau = "Normal",
        string $p_readme = "RAS")
    {
        $this->name = ucfirst(strtolower($p_name));
        $this->description = $p_description;
        $this->duration = $p_duration;
        $this->forbidden18yearOld = $p_18yo;
        $this->open = $p_open;
        $this->minPlayers = $p_minPlayers;
        $this->maxPlayers = $p_maxPlayers;
        $this->niveau = $p_niveau;
        $this->readme = $p_readme;
    }
    
    public function getName(): string
    {
        return ucfirst(strtolower($this->name));
    }
    public function setName(string $value)
    {
        $this->name = ucfirst(strtolower($value));
    }
    
    public function setOpen(array $value)
    {
        $this->open = $value;
    }
    
    public function setNiveau(string $value)
    {
        if($value == 'Difficile' ||
            $value == 'Normal' ||
            $value == 'Facile') {
            $this->niveau = htmlentities($value);
        } else {
            throw new Exception('Niveau inconnu');
        }
    }
    
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
      return [
        'name'        => $this->name,
        'description' => $this->description,
        'duration'    => $this->duration,
        'forbidden'   => $this->forbidden18yearOld,
        'open'        => $this->open,
        'minPlayers'  => $this->minPlayers,
        'maxPlayers'  => $this->maxPlayers,
        'niveau'      => $this->niveau,
        'readme'      => $this->readme,
      ] ;
    }
}
