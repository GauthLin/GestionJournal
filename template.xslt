<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                              xmlns:fo="http://www.w3.org/1999/XSL/Format">
  <xsl:output method="xml" indent="yes"/>

  <!-- Permet de ne as afficher toutes les balises -->
  <xsl:template match="*"></xsl:template>

  <xsl:template match="/">
    <fo:root>
      <!-- Template des différentes pages -->
      <fo:layout-master-set>
        <!-- Template des autres pages -->
        <fo:simple-page-master master-name="pages" page-width="210mm" page-height="297mm" margin="10mm">
          <fo:region-body region-name="body" margin="10mm 15mm"/>
          <fo:region-before region-name="header" extent="10mm"/>
          <fo:region-after region-name="footer" extent="10mm"/>
        </fo:simple-page-master>
      </fo:layout-master-set>

      <fo:page-sequence master-reference="pages">
        <!-- Pied de page pour toutes les autres pages -->
        <fo:static-content flow-name="footer">
          <fo:block text-align="center" font-size="small">
            Page <fo:page-number/>
          </fo:block>
        </fo:static-content>

        <xsl:apply-templates />
      </fo:page-sequence>
    </fo:root>
  </xsl:template>

  <xsl:template match="journal">
    <!-- Header du journal -->
    <fo:static-content flow-name="header">
      <fo:block text-align="center" font-size="xx-large">
        Journal du <xsl:value-of select="@date"/>
      </fo:block>
    </fo:static-content>

    <!-- Body de la page -->
    <fo:flow flow-name="body">
      <xsl:apply-templates />
    </fo:flow>
  </xsl:template>

  <!-- Pour chaque article -->
  <xsl:template match="article">
    <fo:block>
      <!-- Affichage du titre -->
      <fo:inline font-size="large" color="green">
        <xsl:value-of select="titre"/>
      </fo:inline>

      <!-- Affichage des auteurs -->
      <fo:inline font-size="small" color="gray">
        <xsl:value-of select="auteur"/>
      </fo:inline>
    </fo:block>

    <xsl:apply-templates />
  </xsl:template>

  <!-- Affichage du contenu -->
  <xsl:template match="contenu">
    <fo:block margin-top="10pt">
      <xsl:value-of select="."/>
    </fo:block>
  </xsl:template>
</xsl:stylesheet>
