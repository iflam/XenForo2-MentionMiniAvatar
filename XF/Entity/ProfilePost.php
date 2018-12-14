<?php

namespace LiamW\MentionMiniAvatar\XF\Entity;

use LiamW\MentionMiniAvatar\Entity\MentionMiniAvatarTrait;
use XF\Mvc\Entity\Structure;

class ProfilePost extends XFCP_ProfilePost
{
	use MentionMiniAvatarTrait;

	public function getBbCodeRenderOptions($context, $type)
	{
		return $this->addMentionMiniAvatarBbCodeRenderOptions(parent::getBbCodeRenderOptions($context, $type));
	}

	public static function getStructure(Structure $structure)
	{
		return static::addMentionMiniAvatarStructureElements(parent::getStructure($structure));
	}

	public function setLatestComments(array $latest)
	{
		parent::setLatestComments($latest);

		// If you can think of a better way, please let me know...
		// I do think the embed metadata stuff needs an overhaul.

		if (\XF::$versionId >= 2010031)
		{
			$this->repository('LiamW\MentionMiniAvatar:Mentions')->addMentionsToContent($latest);
		}
	}
}