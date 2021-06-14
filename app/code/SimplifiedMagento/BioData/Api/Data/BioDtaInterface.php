<?php


namespace SimplifiedMagento\BioData\Api\Data;



interface BiodataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const BIODATA_ID = 'biodata_id';
    const NAME = 'name';
    const FATHER_NAME = 'father_name';
    const MOTHER_NAME = 'mother_name';
    const CONTACT_NUMBER = 'contact_number';
    const EMAIL = 'email';
    const HEIGHT = 'height';
    const WEIGHT = 'weight';
    const DOB = 'dob';
    const HOBBY = 'hobby';
    const GENDER = 'gender';
    const COMPLEXION = 'complexion';
    const ADDRESS = 'address';
    const CANDIDATE_IMAGE = 'candidate_image';
    const ABOUT_SELF = 'about_self';
    const IS_HOROSCOPE = 'is_horoscope';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get BiodataId.
     *
     * @return int
     */
    public function getBiodataId();

    /**
     * Set BiodataId.
     */
    public function setBiodataId($biodataId);

    /**
     * Get Name.
     *
     * @return varchar
     */
    public function getName();

    /**
     * Set Name.
     */
    public function setName($name);

    /**
     * Get FatherName.
     *
     * @return varchar
     */
    public function getFatherName();

    /**
     * Set FatherName.
     */
    public function setFatherName($fathername);

    /**
     * Get MotherName.
     *
     * @return varchar
     */
    public function getMotherName();

    /**
     * Set MotherName.
     */
    public function setMotherName($mothername);

    /**
     * Get ContactNumber.
     *
     * @return varchar
     */
    public function getContactNumber();

    /**
     * Set ContactNumber.
     */
    public function setContactNumber($contact_number);

    /**
     * Get Email.
     *
     * @return varchar
     */
    public function getEmail();

    /**
     * Set Email.
     */
    public function setEmail($email);

    /**
     * Get Height.
     *
     * @return varchar
     */
    public function getHeight();

    /**
     * Set Height.
     */
    public function setHeight($height);

    /**
     * Get Weight.
     *
     * @return int
     */
    public function getWeight();

    /**
     * Set Weight.
     */
    public function setWeight($weight);

    /**
     * Get Dob.
     *
     * @return int
     */
    public function getDob();

    /**
     * Set Dob.
     */
    public function setDob($dob);

    /**
     * Get Hobby.
     *
     * @return varchar
     */
    public function getHobby();

    /**
     * Set Hobby.
     */
    public function setHobby($hobby);

    /**
     * Get Gender.
     *
     * @return varchar
     */
    public function getGender();

    /**
     * Set Gender.
     */
    public function setGender($gender);

    /**
     * Get Complexion.
     *
     * @return varchar
     */
    public function getComplexion();

    /**
     * Set Complexion.
     */
    public function setComplexion($complexion);

    /**
     * Get Address.
     *
     * @return varchar
     */
    public function getAddress();

    /**
     * Set Address.
     */
    public function setAddress($address);

    /**
     * Get CandidateImage.
     *
     * @return varchar
     */
    public function getCandidateImage();

    /**
     * Set CandidateImage.
     */
    public function setCandidateImage($candidate_image);

    /**
     * Get AboutSelf.
     *
     * @return varchar
     */
    public function getAboutSelf();

    /**
     * Set AboutSelf.
     */
    public function setAboutSelf($about_self);


    /**
     * Get IsHoroscope.
     *
     * @return int
     */
    public function getIsHoroscope();

    /**
     * Set IsHoroscope.
     */
    public function setIsHoroscope($is_horoscope);

    /**
     * Get Status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set Status.
     */
    public function setStatus($status);


    /**
     * Get UpdatedAt.
     *
     * @return int
     */
    public function getUpdatedAt();

    /**
     * Set UpdatedAt.
     */
    public function setUpdatedAt($updatedAt);


    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt();

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt);

}