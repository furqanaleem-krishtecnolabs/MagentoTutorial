<?php


namespace SimplifiedMagento\BioData\Model;
use SimplifiedMagento\BioData\Api\Data\BiodataInterface;

class BioData extends \Magento\Framework\Model\AbstractModel implements BiodataInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'biodata_details';

    /**
     * @var string
     */
    protected $_cacheTag = 'biodata_details';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'biodata_details';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Surbhitest\Biodata\Model\ResourceModel\Biodata');
    }
    /**
     * Get BiodataId.
     *
     * @return int
     */
    public function getBiodataId()
    {
        return $this->getData(self::BIODATA_ID);
    }

    /**
     * Set BiodataId.
     */
    public function setBiodataId($biodataId)
    {
        return $this->setData(self::BIODATA_ID, $biodataId);
    }

    /**
     * Get Name.
     *
     * @return varchar
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name.
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get getFatherName.
     *
     * @return varchar
     */
    public function getFatherName()
    {
        return $this->getData(self::FATHER_NAME);
    }

    /**
     * Set FatherName.
     */
    public function setFatherName($fathername)
    {
        return $this->setData(self::FATHER_NAME, $fathername);
    }

    /**
     * Get MotherName.
     *
     * @return varchar
     */
    public function getMotherName()
    {
        return $this->getData(self::MOTHER_NAME);
    }

    /**
     * Set MotherName.
     */
    public function setMotherName($mothername)
    {
        return $this->setData(self::MOTHER_NAME, $mothername);
    }

    /**
     * Get ContactNumber.
     *
     * @return varchar
     */
    public function getContactNumber()
    {
        return $this->getData(self::CONTACT_NUMBER);
    }

    /**
     * Set ContactNumber.
     */
    public function setContactNumber($contact_number)
    {
        return $this->setData(self::CONTACT_NUMBER, $contact_number);
    }

    /**
     * Get Email.
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set Email.
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get Height.
     *
     * @return varchar
     */
    public function getHeight()
    {
        return $this->getData(self::HEIGHT);
    }

    /**
     * Set Height.
     */
    public function setHeight($height)
    {
        return $this->setData(self::HEIGHT, $height);
    }


    /**
     * Get Weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->getData(self::WEIGHT);
    }

    /**
     * Set Weight.
     */
    public function setWeight($weight)
    {
        return $this->setData(self::WEIGHT, $weight);
    }

    /**
     * Get Dob.
     *
     * @return varchar
     */
    public function getDob()
    {
        return $this->getData(self::DOB);
    }

    /**
     * Set Dob.
     */
    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }

    /**
     * Get Hobby.
     *
     * @return varchar
     */
    public function getHobby()
    {
        return $this->getData(self::HOBBY);
    }

    /**
     * Set Hobby.
     */
    public function setHobby($hobby)
    {
        return $this->setData(self::HOBBY, $hobby);
    }

    /**
     * Get Gender.
     *
     * @return varchar
     */
    public function getGender()
    {
        return $this->getData(self::GENDER);
    }

    /**
     * Set Gender.
     */
    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    /**
     * Get Complexion.
     *
     * @return varchar
     */
    public function getComplexion()
    {
        return $this->getData(self::COMPLEXION);
    }

    /**
     * Set Complexion.
     */
    public function setComplexion($complexion)
    {
        return $this->setData(self::COMPLEXION, $complexion);
    }

    /**
     * Get Address.
     *
     * @return varchar
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * Set Address.
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Get CandidateImage.
     *
     * @return varchar
     */
    public function getCandidateImage()
    {
        return $this->getData(self::CANDIDATE_IMAGE);
    }

    /**
     * Set CandidateImage.
     */
    public function setCandidateImage($candidate_image)
    {
        return $this->setData(self::CANDIDATE_IMAGE, $candidate_image);
    }

    /**
     * Get AboutSelf.
     *
     * @return varchar
     */
    public function getAboutSelf()
    {
        return $this->getData(self::ABOUT_SELF);
    }

    /**
     * Set AboutSelf.
     */
    public function setAboutSelf($about_self)
    {
        return $this->setData(self::ABOUT_SELF, $about_self);
    }


    /**
     * Get IsHoroscope.
     *
     * @return int
     */
    public function getIsHoroscope()
    {
        return $this->getData(self::IS_HOROSCOPE);
    }

    /**
     * Set IsHoroscope.
     */
    public function setIsHoroscope($is_horoscope)
    {
        return $this->setData(self::IS_HOROSCOPE, $is_horoscope);
    }


    /**
     * Get Status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Status.
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }


    /**
     * Get UpdatedAt.
     *
     * @return varchar
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set UpdatedAt.
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}